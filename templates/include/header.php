<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo htmlspecialchars( $results['pageTitle'] )?></title>
	<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
	<script src='/js/main.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script>
		tinymce.init({
			selector: '#content-tiny',
			relative_urls: false,
			remove_script_host: false,
			plugins: 'image, imagetools, paste',
			toolbar: 'undo, redo | bold, italic, underline, alignleft, aligncenter, alignright, alignjustify, styleselect, copy, paste, bullist, numlist, outdent, indent, blockquote | image, ',
			file_browser_callback : function(field_name, url, type, win) {
				tinymce.activeEditor.windowManager.open({
					title: "File Picker",
					url: '/pcms/admin.php?action=listResourcesPick',
					width: 825,
					height: 600,
				}, {
				
				oninsert: function(url) {
					win.document.getElementById(field_name).value = url; 
					top.tinymce.activeEditor.windowManager.close();
				}
			});
		}
		});
		
	</script>
	<link href="/pcms/css/normalize.css"  rel="stylesheet">
	<link href="/pcms/css/main.css"  rel="stylesheet">
	<link rel="stylesheet" href="/css/font-awesome-4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
  </head>
