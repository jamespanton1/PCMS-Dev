
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>PantonMcleod Americas News</title>
        <meta name="description" content="PantonMcleod Americas in the news">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/main.css">
		<link rel="stylesheet" href="../css/responsive-nav.css">
		<script src="../js/responsive-nav.js"></script>
        <script src="../js/vendor/modernizr-2.8.3.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
		
		<div id="content-wrapper">
		
		<div class="header-fixed-top header-white section group">
				<div class="header-contain" >
					<div id="logo" class="col">
						<a href="index.html" title="PantonMcleod Americas">
							<img src="img/pma-215.png">
						</a>
					</div>
					
				<div class="col nav nav-top phone-hidden">
					<ul class="nav-list">
						<li> <a href="index.htmlabout.html"> About Us </a> </li>
						<li> <a href="index.htmlabout.html"> Partners </a> </li>
						<li> <a href="news.php.?action=archiveN"> News </a> </li>
						<li> <a href="news.php.?action=archiveCS"> Case Studies and Papers </a> </li>
				</div>
					
				<div class="col nav phone-hidden">
						<ul class="nav-list">
							<li> <a href="water-wells.html"> WATER WELLS </a> </li>
							<li> <a href="tanks.html"> TANKS </a> </li>
							<li> <a href="pantonite.html"> PANTONITE </a> </li>
							<li> <a href="other-services.html"> OTHER SERVICES </a> </li>
					</div>
					
					<div class="col nav-phone">
						<ul class="nav-list-phone">
							<li> <a href="water-wells.html"> ASSET INSPECTION </a> </li>
							<li> <a href="tanks.html"> TANKS </a> </li>
							<li> <a href="pantonite.html"> PANTONITE </a> </li>
							<li> <a href="other-services.html"> OTHER SERVICES </a> </li>
							<li> <a href="about.html"> ABOUT US </a> </li>
							<li> <a href="news.php"> NEWS </a> </li>
					</div>
				</div>
			</div>
			
			<div class="main-hero">
				
				<div class="hero-picture-main bg-asset-news">
					
					<div class="hero-title-main">
						<h5> PantonMcleod Americas News </h5>
						<h2> News, Blogs and White Papers </h2>
						<p>  </p>
					</div>
				</div>
				
				
			</div>
			<div  class="content-contain">
				<div class="section group">
					
						
					<!-- <div class="content-center">	
						<div class="content-list-center content-left">
							<h3> CONFINED SPACE ENTRY </h3>
							<ul class="content-list-items">
								<li> Fully trained confined space teams </li>
								<li> Inspections completed during cleaning window </li>
								<li> Water quality risks communicated immediately </li>
								<li> Where possible small scope defects resolved </li>
								<li> Return to service in most efficient manner </li>
							</ul>
						</div>
						
						<img class="content-list-pic-center content-left" src="img/cleaning.jpg">
						
					</div> -->
					
					
					<?php foreach ( $results['articles'] as $article ) { ?>
					
						<div  class="news-section content-contain content-text-left">
							<div class="section group">
								<div class="col span_4_of_4">
									<div class="content-text-contain-head">
										<a href="news.php.?action=viewArticle&amp;articleId=<?php echo $article->id?>"> <h4> <?php echo htmlspecialchars( $article->title )?> </h4> </a>
										</div>
									<div class="content-text-contain">	
										<p> <i> <?php echo date('j F Y', $article->publicationDate)?> </i> </p>
										<p> <?php echo htmlspecialchars( $article->summary )?> <br /> <br /> <i> Click on the title above to see published article </i> </p>
									</div>
									<hr>
								</div>
							</div>
						</div>
						
					<?php } ?>	
				
			</div>
			
		</div>	
		</div>
		<div class="push"></div>
			
			<div class="footer">
			<div class="footer-contain content-contain">
				<div class="footer-left">
					<p> © Copyright 2016 Ikon Pangonix <br /> <br /> </p>
				</div>
				
				<div class= "footer-right">
					<p style="text-align: right;"> Water Industry Products and Services <br /><br /> </p>
		
				</div>
				
			</div>
			</div>
        
        

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
			<script>
			    var navigation = responsiveNav(".nav-list-phone", {
					animate: true,                    // Boolean: Use CSS3 transitions, true or false
					transition: 284,                  // Integer: Speed of the transition, in milliseconds
					label: "Menu",                    // String: Label for the navigation toggle
					insert: "after",                  // String: Insert the toggle before or after the navigation
					customToggle: "",                 // Selector: Specify the ID of a custom toggle
					closeOnNavClick: false,           // Boolean: Close the navigation when one of the links are clicked
					openPos: "relative",              // String: Position of the opened nav, relative or static
					navClass: "nav-collapse",         // String: Default CSS class. If changed, you need to edit the CSS too!
					navActiveClass: "js-nav-active",  // String: Class that is added to <html> element when nav is active
					jsClass: "js",                    // String: 'JS enabled' class which is added to <html> element
					init: function(){},               // Function: Init callback
					open: function(){},               // Function: Open callback
					close: function(){}               // Function: Close callback
      });
		</script>
    </body>
</html>



