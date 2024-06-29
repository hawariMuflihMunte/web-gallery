import * as FilePond from "filepond";
import "filepond/dist/filepond.min.css";

import FilePondPluginFilePoster from "filepond-plugin-file-poster";
import "filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css";

import FilePondPluginImageEdit from "filepond-plugin-image-edit";
import "filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css";

import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css";

import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import FilePondPluginFileEncode from "filepond-plugin-file-encode";
import FilePondPluginFileMetadata from "filepond-plugin-file-metadata";
import FilePondPluginFileRename from "filepond-plugin-file-rename";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImageExifOrientation from "filepond-plugin-image-exif-orientation";
import FilePondPluginImageValidateSize from "filepond-plugin-image-validate-size";

FilePond.registerPlugin(
  FilePondPluginFileEncode,
  FilePondPluginFileValidateSize,
  FilePondPluginFileMetadata,
  FilePondPluginFilePoster,
  FilePondPluginFileRename,
  FilePondPluginFileValidateType,
  FilePondPluginImageEdit,
  FilePondPluginImageExifOrientation,
  FilePondPluginImagePreview,
  FilePondPluginImageValidateSize,
);

const targetElement = document.querySelector("input[type='file'].filepond");
const csrfToken = document
  .querySelector("meta[name='csrf-token']")
  .getAttribute("content");

FilePond.create(targetElement).setOptions({
  name: "filepond",
  required: true,
  allowMultiple: true,
  maxFiles: 10,
  maxFileSize: "2MB",
  server: {
    url: "http://127.0.0.1:5151",
    process: {
      url: "upload/process",
      method: "POST",
      process: "/upload/process",
      headers: {
        "X-CSRF-TOKEN": csrfToken,
      },
      fetch: null,
      revert: null,
      timeout: 10000,
    },
  },
});
