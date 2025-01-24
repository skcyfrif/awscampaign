KC-finder integrate with CK editor:  /* https://kcfinder.sunhater.com/integrate */
_________________________________________________________________________________________

CKEDITOR.editorConfig = function(config) {
// .................
  var folder_path='http://localhost/2019/ck';
  config.filebrowserBrowseUrl = folder_path+'/kcfinder/browse.php?opener=ckeditor&type=files';
  config.filebrowserImageBrowseUrl = folder_path+'/kcfinder/browse.php?opener=ckeditor&type=images';
  config.filebrowserFlashBrowseUrl = folder_path+'/kcfinder/browse.php?opener=ckeditor&type=flash';
  config.filebrowserUploadUrl = folder_path+'/kcfinder/upload.php?opener=ckeditor&type=files';
  config.filebrowserImageUploadUrl = folder_path+'/kcfinder/upload.php?opener=ckeditor&type=images';
  config.filebrowserFlashUploadUrl = folder_path+'/kcfinder/upload.php?opener=ckeditor&type=flash';
// ................
};
----------------------------------------------------------------------------------------------------------------------------------------------

wiris [math and chemestry symbol integration plugin ] : /* https://docs.wiris.com/en/mathtype/mathtype_web/integrations/html/ckeditor */
____________________________________________________________________________________________________________________________________________

mbstring extension must be installed and enabled in the server.

Give execution rights to the web server user on the PHP files contained at to ckeditor/plugins/ckeditor_wiris/integration.

Give write permissions to ckeditor/plugins/ckeditor_wiris/cache and to ckeditor/plugins/ckeditor_wiris/formulas directories to the web server user. Those folders will be used to store formula MathML codes and temporal images. If you prefer, you can configure the location of these folders.


CKEDITOR.editorConfig = function( config ) {
//.............................
	config.allowedContent = true;
  	config.extraPlugins += (config.extraPlugins.length == 0 ? '' : ',') + 'ckeditor_wiris'; 
//.............................
 
};

