/**
 * Text pattern plugin for TinyMCE
 *
 * @since 4.3.0
 *
 * This plugin can automatically format text patterns as you type. It includes several groups of patterns.
 *
 * Start of line patterns:
 *  As-you-type:
 *  - Unordered list (`* ` and `- `).
 *  - Ordered list (`1. ` and `1) `).
 *
 *  On enter:
 *  - h2 (## ).
 *  - h3 (### ).
 *  - h4 (#### ).
 *  - h5 (##### ).
 *  - h6 (###### ).
 *  - blockquote (> ).
 *  - hr (---).
 *
 * Inline patterns:
 *  - <code> (`) (backtick).
 *
 * If the transformation in unwanted, the user can undo the change by pressing backspace,
 * using the undo shortcut, or the undo button in the toolbar.
 *
 * Setting for the patterns can be overridden by plugins by using the `tiny_mce_before_init` PHP filter.
 * The setting name is `wptextpattern` and the value is an object containing override arrays for each
 * patterns group. There are three groups: "space", "enter", and "inline". Example (PHP):
 *
 * add_filter( 'tiny_mce_before_init', 'my_mce_init_wptextpattern' );
 * function my_mce_init_wptextpattern( $init ) {
 *   $init['wptextpattern'] = wp_json_encode( array(
 *      'inline' => array(
 *        array( 'delimiter' => '**', 'format' => 'bold' ),
 *        array( 'delimiter' => '__', 'format' => 'italic' ),
 *      ),
 *   ) );
 *
 *   return $init;
 * }
 *
 * Note that setting this will override the default text patterns. You will need to include them
 * in your settings array if you want to keep them working.
 */
(function (tinymce, setTimeout) {
  if (tinymce.Env.ie && tinymce.Env.ie < 9) {
    return;
  }

  /**
   * Escapes characters for use in a Regular Expression.
   *
   * @param {String} string Characters to escape
   *
   * @return {String} Escaped characters
   */
  function escapeRegExp(string) {
    return string.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
  }

  tinymce.PluginManager.add("wptextpattern", function (editor) {
    var VK = tinymce.util.VK;
    var settings = editor.settings.wptextpattern || {};

    var spacePatterns = settings.space || [
      { regExp: /^[*-]\s/, cmd: "InsertUnorderedList" },
      { regExp: /^1[.)]\s/, cmd: "InsertOrderedList" },
    ];

    var enterPatterns = settings.enter || [
      { start: "##", format: "h2" },
      { start: "###", format: "h3" },
      { start: "####", format: "h4" },
      { start: "#####", format: "h5" },
      { start: "######", format: "h6" },
      { start: ">", format: "blockquote" },
      { regExp: /^(-){3,}$/, element: "hr" },
    ];

    var inlinePatterns = settings.inline || [
      { delimiter: "`", format: "code" },
    ];

    var canUndo;

    editor.on("selectionchange", function () {
      canUndo = null;
    });

    editor.on(
      "keydown",
      function (event) {
        if (
          (canUndo && event.keyCode === 27) /* ESCAPE */ ||
          (canUndo === "space" && event.keyCode === VK.BACKSPACE)
        ) {
          editor.undoManager.undo();
          event.preventDefault();
          event.stopImmediatePropagation();
        }

        if (VK.metaKeyPressed(event)) {
          return;
        }

        if (event.keyCode === VK.ENTER) {
          enter();
          // Wait for the browser to insert the character.
        } else if (event.keyCode === VK.SPACEBAR) {
          setTimeout(space);
        } else if (
          event.keyCode > 47 &&
          !(event.keyCode >= 91 && event.keyCode <= 93)
        ) {
          setTimeout(inline);
        }
      },
      true,
    );

    function inline() {
      var rng = editor.selection.getRng();
      var node = rng.startContainer;
      var offset = rng.startOffset;
      var startOffset;
      var endOffset;
      var pattern;
      var format;
      var zero;

      // We need a non-empty text node with an offset greater than zero.
      if (!node || node.nodeType !== 3 || !node.data.length || !offset) {
        return;
      }

      var string = node.data.slice(0, offset);
      var lastChar = node.data.charAt(offset - 1);

      tinymce.each(inlinePatterns, function (p) {
        // Character before selection should be delimiter.
        if (lastChar !== p.delimiter.slice(-1)) {
          return;
        }

        var escDelimiter = escapeRegExp(p.delimiter);
        var delimiterFirstChar = p.delimiter.charAt(0);
        var regExp = new RegExp(
          "(.*)" + escDelimiter + ".+" + escDelimiter + "$",
        );
        var match = string.match(regExp);

        if (!match) {
          return;
        }

        startOffset = match[1].length;
        endOffset = offset - p.delimiter.length;

        var before = string.charAt(startOffset - 1);
        var after = string.charAt(startOffset + p.delimiter.length);

        // test*test*  => format applied.
        // test *test* => applied.
        // test* test* => not applied.
        if (startOffset && /\S/.test(before)) {
          if (/\s/.test(after) || before === delimiterFirstChar) {
            return;
          }
        }

        // Do not replace when only whitespace and delimiter characters.
        if (
          new RegExp("^[\\s" + escapeRegExp(delimiterFirstChar) + "]+$").test(
            string.slice(startOffset, endOffset),
          )
        ) {
          return;
        }

        pattern = p;

        return false;
      });

      if (!pattern) {
        return;
      }

      format = editor.formatter.get(pattern.format);

      if (format && format[0].inline) {
        editor.undoManager.add();

        editor.undoManager.transact(function () {
          node.insertData(offset, "\uFEFF");

          node = node.splitText(startOffset);
          zero = node.splitText(offset - startOffset);

          node.deleteData(0, pattern.delimiter.length);
          node.deleteData(
            node.data.length - pattern.delimiter.length,
            pattern.delimiter.length,
          );

          editor.formatter.apply(pattern.format, {}, node);

          editor.selection.setCursorLocation(zero, 1);
        });

        // We need to wait for native events to be triggered.
        setTimeout(function () {
          canUndo = "space";

          editor.once("selectionchange", function () {
            var offset;

            if (zero) {
              offset = zero.data.indexOf("\uFEFF");

              if (offset !== -1) {
                zero.deleteData(offset, offset + 1);
              }
            }
          });
        });
      }
    }

    function firstTextNode(node) {
      var parent = editor.dom.getParent(node, "p"),
        child;

      if (!parent) {
        return;
      }

      while ((child = parent.firstChild)) {
        if (child.nodeType !== 3) {
          parent = child;
        } else {
          break;
        }
      }

      if (!child) {
        return;
      }

      if (!child.data) {
        if (child.nextSibling && child.nextSibling.nodeType === 3) {
          child = child.nextSibling;
        } else {
          child = null;
        }
      }

      return child;
    }

    function space() {
      var rng = editor.selection.getRng(),
        node = rng.startContainer,
        parent,
        text;

      if (!node || firstTextNode(node) !== node) {
        return;
      }

      parent = node.parentNode;
      text = node.data;

      tinymce.each(spacePatterns, function (pattern) {
        var match = text.match(pattern.regExp);

        if (!match || rng.startOffset !== match[0].length) {
          return;
        }

        editor.undoManager.add();

        editor.undoManager.transact(function () {
          node.deleteData(0, match[0].length);

          if (!parent.innerHTML) {
            parent.appendChild(document.createElement("br"));
          }

          editor.selection.setCursorLocation(parent);
          editor.execCommand(pattern.cmd);
        });

        // We need to wait for native events to be triggered.
        setTimeout(function () {
          canUndo = "space";
        });

        return false;
      });
    }

    function enter() {
      var rng = editor.selection.getRng(),
        start = rng.startContainer,
        node = firstTextNode(start),
        i = enterPatterns.length,
        text,
        pattern,
        parent;

      if (!node) {
        return;
      }

      text = node.data;

      while (i--) {
        if (enterPatterns[i].start) {
          if (text.indexOf(enterPatterns[i].start) === 0) {
            pattern = enterPatterns[i];
            break;
          }
        } else if (enterPatterns[i].regExp) {
          if (enterPatterns[i].regExp.test(text)) {
            pattern = enterPatterns[i];
            break;
          }
        }
      }

      if (!pattern) {
        return;
      }

      if (node === start && tinymce.trim(text) === pattern.start) {
        return;
      }

      editor.once("keyup", function () {
        editor.undoManager.add();

        editor.undoManager.transact(function () {
          if (pattern.format) {
            editor.formatter.apply(pattern.format, {}, node);
            node.replaceData(
              0,
              node.data.length,
              ltrim(node.data.slice(pattern.start.length)),
            );
          } else if (pattern.element) {
            parent = node.parentNode && node.parentNode.parentNode;

            if (parent) {
              parent.replaceChild(
                document.createElement(pattern.element),
                node.parentNode,
              );
            }
          }
        });

        // We need to wait for native events to be triggered.
        setTimeout(function () {
          canUndo = "enter";
        });
      });
    }

    function ltrim(text) {
      return text ? text.replace(/^\s+/, "") : "";
    }
  });
})(window.tinymce, window.setTimeout);
