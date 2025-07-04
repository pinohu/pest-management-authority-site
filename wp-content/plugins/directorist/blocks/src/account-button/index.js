import { registerBlockType } from "@wordpress/blocks";
import { __ } from "@wordpress/i18n";
import Edit from "./edit";
import save from "./save";
import metadata from "./block.json";

import "./style.scss";

import getLogo from "./../logo";

registerBlockType(metadata.name, {
  icon: getLogo(),

  /**
   * @see ./edit.js
   */
  edit: Edit,
  /**
   * @see ./save.js
   */
  save,
});
