<?php include "templates/include/header.php" ?>
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
					<h1>Articles</h1> 
				</div>
				</div>
				
				<div class="dashboard-section">
			
				
				<div class="dashboard-section-header">
					<div class="header-title">
					<h3><?php echo $results['pageTitle']?></h3>	
					</div>
					<?php if ($results['pageTitle'] == 'Edit Article'){ ?>
					<a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id?>" onclick="return confirm('Are you sure you want to delete this article')"><div class="button-right"> Delete Article <i class="fa fa-trash" aria-hidden="true"></i> </div></a>
					<?php } ?>
				</div>
			  
				<?php if ( isset( $results['errorMessage'] ) ) { ?>
					<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
				<?php } ?>
		 
		 
				<?php if ( isset( $results['statusMessage'] ) ) { ?>
					<div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
				<?php } ?>
		 
    
 
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post">
        <input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul class="content-entry-field">
 
          <li>
            <label for="title">Article Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->title )?>" />
          </li>
		    
        <li>
            <label for="tpye">Article Image</label>
            <select name="articleImage" id="articleImage">
                <?php foreach ( $results['images'] as $image ) { ?>
                <option value="<?php echo htmlspecialchars($image->imageFilename) ?>">
                    <?php echo htmlspecialchars($image->imageFilename) ?>
                </option> 
                <?php } ?>
			</select>
          </li>
 
          <li>
            <label for="summary">Article Summary</label>
            <textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000"><?php echo htmlspecialchars( $results['article']->summary )?></textarea>
          </li>
 
		   <li>
            <textarea name="content" id="content-tiny" placeholder="The HTML content of the article"  maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['article']->content )?></textarea>
          </li>
			
			
          <li>
            <label for="publicationDate">Publication Date</label>
            <input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['article']->publicationDate ? date( "Y-m-d", $results['article']->publicationDate ) : "" ?>" />
          </li>
 
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
          <div class="submit-button-alt">
			<input type="submit" formnovalidate name="cancel" value="Cancel" class="button-alt"/>
		  </div>
        </div>
 
      </form>
		 
			
			</div>
				
			</div>
		</div>
	</div>
	
	