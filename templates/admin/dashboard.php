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
					<h1>Articles </h1> 
				</div>
				<div class="header-stats">
					<h4>TOTAL ARTICLES</h3> <h2> <?php echo $results['totalRows']?> </h2>
				</div>
				</div>
				
				<div class="dashboard-section">
				
					
					<div class="dashboard-section-header">
						
						<div class="header-title">
							<h3>Article List</h3>
						</div>
						
						<div class= "button"> <a href="admin.php?action=newArticle">New Article &nbsp <i class="fa fa-plus" aria-hidden="true"></i></a> </div>	
					</div>
					
				  
					<?php if ( isset( $results['errorMessage'] ) ) { ?>
						<div class="errorMessage">
								<p><?php echo $results['errorMessage'] ?></p>
							</div>
					<?php } ?>
			 
			 
					<?php if ( isset( $results['statusMessage'] ) ) { ?>
								<div class="statusMessage">
									<p><?php echo $results['statusMessage'] ?></p>
								</div>
						<?php } ?>
			 
					<table class="table-list">
						<tr>
						  <th>Article Title</th>
						  <th>Publication Date</th>
						  <th id="articleEditTh"></th>
						</tr>
			 
					<?php foreach ( $results['articles'] as $article ) { ?>
						<tr>
						  <td>
							<?php echo $article->title?>
						  </td>
						  
						  <td><?php echo date('j M Y', $article->publicationDate)?></td>
						  <td id="articleEditTd" onclick="location='admin.php?action=editArticle&amp;articleId=<?php echo $article->id?>'"> <i class="fa fa-pencil-square-o edit-click" aria-hidden="true"></i> </td>
						</tr>
					<?php } ?>
				  </table>
					<div class="dashboard-section-footer">
						<div class= "button"> <a href="admin.php?action=newArticle">New Article &nbsp <i class="fa fa-plus" aria-hidden="true"></i></a> </div>	
					</div>
				</div>
				
			</div>
		</div>
	</div>
	