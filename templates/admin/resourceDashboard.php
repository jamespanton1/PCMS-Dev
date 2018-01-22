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
					<h1>Resources</h1> 
				</div>
				<div class="header-stats">
					<h4>TOTAL Resources</h3> <h2> <?php echo $results['totalRows']?> </h2>
				</div>
				</div>
				
				<div class="dashboard-section">
				
					
					<div class="dashboard-section-header">
						
						<div class="header-title">
							<h3>Resource List</h3>
						</div>
						
						<div class= "button"> <a href="admin.php?action=newResource">New Image &nbsp <i class="fa fa-plus" aria-hidden="true"></i></a> </div>	
					</div>
					
					<div class="resource-list-section">
				  
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
	 
						 
					
							<?php foreach ( $results['resources'] as $resources ) { ?>
								<div onclick="location='admin.php?action=resourceDashboardDetails&amp;imageId=<?php echo $resources->imageId?>'" class="resource-pannel">
									<div class="resource-pannel-image">
										<div class="image-title">
											<p> <?php echo $resources->imageTitle ?> </p>
										</div>
										<div class="resource-pannel-image-filter"> 
						
										</div>
										<img src="/pcms/resources/thumb/<?php echo $resources->imageFilename ?>">
									</div>
								</div>
							<?php } ?>
						
					</div>
					
					<div class="dashboard-section-footer">
						<div class= "button"> <a href="admin.php?action=newResource">New Image &nbsp <i class="fa fa-plus" aria-hidden="true"></i></a> </div>	
					</div>
				</div>
				
			</div>
		</div>
	</div>