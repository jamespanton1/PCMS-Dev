<?php include "templates/include/header.php" ?>
<body id="resourcePickerPage">
	<div id="wrapper">
		
		
					<div class="resource-list-section">
							
							<h4> Click a picture to insert </h4>
							
							<?php foreach ( $results['resources'] as $resources ) { ?>
							<form >
								<div class="resource-pannel">
									<div class="resource-pannel-image edit-click">
										<div class="image-title">
											<p> <?php echo $resources->imageTitle ?> </p>
										</div>
										<div class="resource-pannel-image-filter"> 
						
										</div>
										<img src="/pcms/resources/thumb/<?php echo $resources->imageFilename ?>">
									</div>
									<input type="hidden" class="filePath" value="/pcms/resources/fullsize/<?php echo $resources->imageFilename ?>">
								</div>
								
							</form>
							<?php } ?>
						<script>
							$(document).ready(function() {
								$('.resource-pannel').click(function() {
									var $submittedValue = $(this).find('.filePath').val();
									formSubmitted($(this).find('.filePath').val());
									});
								});
							
							function formSubmitted(filePathUrl){
							top.tinymce.activeEditor.windowManager.getParams().oninsert(filePathUrl);
							}
						</script>
					</div>
				
			</div>
		</div>
	</div>
</body>