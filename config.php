<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Europe/London" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=db700671125.db.1and1.com;dbname=db700671125" );
define( "DB_USERNAME", "dbo700671125" );
define( "DB_PASSWORD", "G76onu123!" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "mypass" );
define( "ARTICLE_IMAGE_PATH", "resources" );
define( "IMG_TYPE_FULLSIZE", "fullsize" );
define( "IMG_TYPE_THUMB", "thumb" );
define( "ARTICLE_THUMB_WIDTH", 180 );
define( "JPEG_QUALITY", 85 );
require( CLASS_PATH . "/article.php" );
require( CLASS_PATH . "/resources.php" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>