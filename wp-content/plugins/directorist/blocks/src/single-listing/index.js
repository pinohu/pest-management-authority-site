import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps } from "@wordpress/block-editor";
import ServerSideRender from "@wordpress/server-side-render";
import { __ } from "@wordpress/i18n";

import { getPlaceholder } from "./../functions";
import metadata from "./block.json";
import getLogo from "./../logo";

const Placeholder = () => getPlaceholder("single-listing");

registerBlockType(metadata.name, {
  icon: getLogo(),

  supports: {
    html: false,
  },

  edit({ attributes }) {
    return (
      <div
        {...useBlockProps({
          className: "directorist-content-active directorist-w-100",
        })}
      >
        <ServerSideRender
          block={metadata.name}
          attributes={attributes}
          LoadingResponsePlaceholder={Placeholder}
        />
      </div>
    );
  },
});
