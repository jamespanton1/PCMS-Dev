<?php include "templates/include/header.php" ?>
	
	<div id="login-wrapper">
		<div class="login-logo">
		<img src="/pcms/img/logo-login.png">
		</div>
		<div class="login-contain">
			  <div class="login-pannel">
				  <form action="admin.php?action=login" method="post" >
					<input type="hidden" name="login" value="true" />
			 
					<?php if ( isset( $results['errorMessage'] ) ) { ?>
						<div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
					<?php } ?> 
					<ul class="login-form">
			 
					  <li>
						<input class="login-field" type="text" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
					  </li>
			 
					  <li>
						<input class="login-field" type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
					  </li>
			 
					</ul>
			 
					<div class="login-buttons">
					  <input type="submit" name="login" value="Login" />
					</div>
			 
				  </form>
				</div>
		</div>
	</div>
 
