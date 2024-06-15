import * as FilePond from 'filepond';
import 'filepond/dist/filepond.min.css';
import FilePondPluginFilePoster from 'filepond-plugin-file-poster';
import 'filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css';

import FilePondPluginImageEdit from 'filepond-plugin-image-edit';
import 'filepond-plugin-image-edit/dist/filepond-plugin-image-edit.css';

import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css';

import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginFileEncode from 'filepond-plugin-file-encode';
import FilePondPluginFileMetadata from 'filepond-plugin-file-metadata';
import FilePondPluginFileRename from 'filepond-plugin-file-rename';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';

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
  FilePondPluginImageValidateSize
)

FilePond.create(document.querySelector('.filepond'));

FilePond.setOptions({
  name: 'filepond',
  required: true,
  multiple: true,
  maxFiles: 10,
  maxFileSize: 2, // 2 MB
});
