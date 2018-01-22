<?php include "templates/include/header.php" ?>

	 <script>
 
      // Prevents file upload hangs in Mac Safari
      // Inspired by http://airbladesoftware.com/notes/note-to-self-prevent-uploads-hanging-in-safari
 
      function closeKeepAlive() {
        if ( /AppleWebKit|MSIE/.test( navigator.userAgent) ) {
          var xhr = new XMLHttpRequest();
          xhr.open( "GET", "/ping/close", false );
          xhr.send();
        }
      }
 
      </script>
	  
	<div id="wrapper">
		
		<div class="admin-main-header">
			<div class="admin-top-nav-title">
				<img id="logo-dash" src="/pcms/img/logo-dashboard.png">
			</div>
			<div class="admin-top-nav-right">
				<ul class="admin-top-nav-links">
					<li> <a href="admin.php?action=userinfo"?> <i class="fa fa-user" aria-hidden="true"> </i></a></li>
					<li> <a href="admin.php?action=logout"?><i class="fa fa-power-off" aria-hidden="true"></i></a> </li>
				</ul>
			</div>
		</div>
			
		<div class="dashboard-main">
			
            <?php include "templates/include/sidebar.php" ?>
			
			<div class="dashboard-main-content">
			
				<div class="dashboard-header">
				<div class="header-title">
					<h1>Resources</h1> 
				</div>
				</div>
				
				<div class="dashboard-section">
			
				
				<div class="dashboard-section-header">
					<h3><?php echo $results['pageTitle']?></h3>	
				</div>
			  
				<?php if ( isset( $results['errorMessage'] ) ) { ?>
					<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
				<?php } ?>
		 
		 
				<?php if ( isset( $results['statusMessage'] ) ) { ?>
					<div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
				<?php } ?>
		 
    
 
            <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" enctype="multipart/form-data" onsubmit="closeKeepAlive();umce();ut()">
        <input type="hidden" name="ResourceId" value="<?php echo $results['resources']->imageId ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul class="content-entry-field">
 
          <li>
            <label for="title">Resource Title</label>
            <input type="text" name="imageTitle" id="imageTitle" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['resources']->imageTitle )?>" />
          </li>
 
		<?php if ( $results['resources'] && $imagePath = $results['resources']->getImagePath() ) { ?>
          <li>
            <label>Current Image</label>
            <img id="articleImage" src="<?php echo $imagePath ?>" alt="Article Image" />
          </li>
 
          <li>
            <label></label>
            <input type="checkbox" name="deleteImage" id="deleteImage" value="yes"/ > <label for="deleteImage">Delete</label>
          </li>
          <?php } ?>
 
          <li>
            <label for="image">New Image</label>
            <input type="file" name="imagePathFull" id="imagePathFull" placeholder="Choose an image to upload" maxlength="255" />
          </li>
 
        </ul>
 
        <div class="buttons">
          <input type="submit" id="new-article-submit" name="uploadResource" value="Save Changes" />
		  <div class="submit-button-alt">
			<input type="submit" formnovalidate name="cancel" value="Cancel" />
		  </div>
        </div>
 
      </form>
		 
			
			</div>
				
			</div>
		</div>
	</div>
  
  
