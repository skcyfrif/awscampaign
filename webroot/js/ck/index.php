<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>A Simple Page with CKEditor</title>
        <!-- Make sure the path to CKEditor is correct. -->
        <script src="ckeditor/ckeditor.js"></script>
    </head>
    <body>
        <form method='post'>
            <textarea name="editor1" id="editor1" rows="10" cols="80">This is is my textarea to be replaced with CKEditor.</textarea>
            <button type="Submit">Post</button>
        </form>
        
        	<?php
				if(!empty($_POST['editor1'])){
					echo "<p style='margin-top:20px;'>Output :</p><div style='width: 100%;border: 1px dotted red;'>".$_POST['editor1']."</div>";
				}
			?>
        <script>
            CKEDITOR.replace( 'editor1' );
        </script>
    </body>
</html>
