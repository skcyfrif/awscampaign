/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {

	config.skin = 'moono-lisa';
  config.allowedContent = true;
  var folder_path='http://localhost/2020/test_cake3_8/js/ck/';
  config.filebrowserBrowseUrl = folder_path+'kcfinder/browse.php?opener=ckeditor&type=files';
  config.filebrowserImageBrowseUrl = folder_path+'kcfinder/browse.php?opener=ckeditor&type=images';
  config.filebrowserFlashBrowseUrl = folder_path+'kcfinder/browse.php?opener=ckeditor&type=flash';
  config.filebrowserUploadUrl = folder_path+'kcfinder/upload.php?opener=ckeditor&type=files';
  config.filebrowserImageUploadUrl = folder_path+'kcfinder/upload.php?opener=ckeditor&type=images';
  config.filebrowserFlashUploadUrl = folder_path+'kcfinder/upload.php?opener=ckeditor&type=flash';

  // config.filebrowserBrowseUrl = folder_path + 'kcfinder/browse.php?type=files';
  // config.filebrowserImageBrowseUrl = folder_path + 'kcfinder/browse.php?type=images';
  // config.filebrowserFlashBrowseUrl = folder_path + 'kcfinder/browse.php?type=flash';
  // config.filebrowserUploadUrl = folder_path + 'kcfinder/upload.php?type=files';
  // config.filebrowserImageUploadUrl = folder_path + 'kcfinder/upload.php?type=images';
  // config.filebrowserFlashUploadUrl = folder_path + 'kcfinder/upload.php?type=flash';

//Tool bar custome configuration

//  config.toolbarGroups = [
//   {name: 'clipboard', groups: ['clipboard', 'undo']},
//   {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
//   {name: 'links'},
//   {name: 'insert'},
//   {name: 'forms'},
//   {name: 'tools'},
//   {name: 'document', groups: ['mode', 'document', 'doctools']},
//   {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
//   {name: 'styles'},
//   {name: 'colors'},
//   {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
//   {name: 'others'},
//   {name: 'about'},
//   '/',
//  ];

  // Allow blank i tag
  /*
   	config.protectedSource.push( /<i class[\s\S]*?\>/g );
    config.protectedSource.push( /<\/i>/g );
    */

    // Allow blank i and span tag
    //config.protectedSource.push(/<i[^>]*><\/i>/g);
    //config.protectedSource.push(/<span[^>]*>[^>]*<\/span>/g);

    //  // Remove some buttons from toolbar
 		config.removeButtons = 'Flash,About';

//  // Se the most common block elements.
//  config.format_tags = 'p;h1;h2;h3;pre';

//  // Make dialogs simpler.[remove dialog tabs]
 config.removeDialogTabs = 'image:Upload;image:Link;link:upload';
	 
 
};
