<?php

class Resources
{
 
  // Properties
 
/**
  * @var int The recource ID from the database
  */
  public $imageTitle = null;
 
  /**
  * @var int The recource ID from the database
  */
  public $imageId = null;
 
  /**
  * @var int resource file extenstion
  */
  public $imageExtension = "";
 
  /**
  * @var string resource file name
  */
  public $imageFilename = null;
 
 
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['imageId'] ) ) $this->imageId = (int) $data['imageId'];
    if ( isset( $data['imageExtension'] ) ) $this->imageExtension = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\$ a-zA-Z0-9()]/", "", $data['imageExtension'] );
	if ( isset( $data['imageTitle'] ) ) $this->imageTitle = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\$ a-zA-Z0-9()]/", "", $data['imageTitle'] );
    if ( isset( $data['imagePathFull']['name'] ) ) $this->imageFilename = $data['imagePathFull']['name'];
	if ( isset( $data['imageFilename'] ) ) $this->imageFilename = $data['imageFilename'];
 
  }
  
  
  
  /**
  * Stores any image uploaded from the edit form
  *
  * @param assoc The 'image' element from the $_FILES array containing the file upload data
  */
  
  
  
  
  public function storeFormValues ( $params ) {
	
	$filterExtenstion = strtolower( strrchr( $params['imagePathFull']['name'], '.' ) );
	$params['imagePathFull']['name'] = str_replace ( $filterExtenstion , "" , $params['imagePathFull']['name'] );
	
	if ( isset( $params['imagePathFull']['name'] ) ) {
		$params['imagePathFull']['name'] = strtolower($params['imagePathFull']['name']);
		//Make alphanumeric (removes all other characters)
		$params['imagePathFull']['name'] = preg_replace("/[^a-z0-9_\s-]/", "", $params['imagePathFull']['name']);
		//Clean up multiple dashes or whitespaces
		$params['imagePathFull']['name'] = preg_replace("/[\s-]+/", " ", $params['imagePathFull']['name']);
		//Convert whitespaces and underscore to dash
		$params['imagePathFull']['name'] = preg_replace("/[\s_]/", "-", $params['imagePathFull']['name']);
	}  
	
	$params['imagePathFull']['name'] = $params['imagePathFull']['name'] . $filterExtenstion;
	
	
    // Store all the parameters
    $this->__construct( $params );
    // Parse and store the publication date
 
  }
  
  public function filterFileName ($inputFilename){
	  
	  	$filterExtenstion = strtolower( strrchr( $inputFilename['name'], '.' ) );
		$inputFilename['name'] = str_replace ( $filterExtenstion , "" , $inputFilename['name'] );
	
	if ( isset( $inputFilename['name'] ) ) {
		$inputFilename['name'] = strtolower($inputFilename['name']);
		//Make alphanumeric (removes all other characters)
		$inputFilename['name'] = preg_replace("/[^a-z0-9_\s-]/", "", $inputFilename['name']);
		//Clean up multiple dashes or whitespaces
		$inputFilename['name'] = preg_replace("/[\s-]+/", " ", $inputFilename['name']);
		//Convert whitespaces and underscore to dash
		$inputFilename['name'] = preg_replace("/[\s_]/", "-", $inputFilename['name']);
	}  
	
	$inputFilename['name'] = $inputFilename['name'] . $filterExtenstion;
	
	return $inputFilename;
  }
 
  public function storeUploadedImage( $image ) {
	

    if ( $image['error'] == UPLOAD_ERR_OK )
    {
      // Does the resource object have an ID?
      if ( is_null( $this->imageId ) ) trigger_error( "Article::storeUploadedImage(): Attempt to upload an image with no ID", E_USER_ERROR );
 
      // Delete any previous image(s) for this resource
      // $this->deleteImages(); //
 
      // Get and store the image filename extension
      
	  $this->imageExtension = strtolower( strrchr( $image['name'], '.' ) );
      // Store the image
	  
	  $tempFilename = trim( $image['tmp_name'] ); 
	
/*       $tempFilename = trim( $image['tmp_name'] ); 
	  $this->imageFilename = ( $image['name'] ); */
	  
	  
/* 	  $tempPathLocal = ("C:/xampp/htdocs/NorwayCMSdev/pcms/resources/fullsize/" . $this->imageFilename);
	  $tempPathLocalThumb = ("C:/xampp/htdocs/NorwayCMSdev/pcms/resources/thumb/" . $this->imageFilename);
	   */
	   
	  
	  
      if ( is_uploaded_file ( $tempFilename ) ) {
		if ( !( move_uploaded_file( $tempFilename, $this->getImagePath()  ) ) ) trigger_error( "Article::storeUploadedImage(): Couldn't move uploaded file.", E_USER_ERROR );
        if ( !( chmod(  $this->getImagePath(), 0666 ) ) ) trigger_error( "Article::storeUploadedImage(): Couldn't set permissions on uploaded file.", E_USER_ERROR );
      }
	  
 
      // Get the image size and type
      $attrs = getimagesize (  $this->getImagePath() );
      $imageWidth = $attrs[0];
      $imageHeight = $attrs[1];
      $imageType = $attrs[2];
 
      // Load the image into memory
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          $imageResource = imagecreatefromgif (  $this->getImagePath() );
          break;
        case IMAGETYPE_JPEG:
          $imageResource = imagecreatefromjpeg (  $this->getImagePath() );
          break;
        case IMAGETYPE_PNG:
          $imageResource = imagecreatefrompng (  $this->getImagePath() );
          break;
        default:
          trigger_error ( "Article::storeUploadedImage(): Unhandled or unknown image type ($imageType)", E_USER_ERROR );
      }
 
      // Copy and resize the image to create the thumbnail
      $thumbHeight = intval ( $imageHeight / $imageWidth * ARTICLE_THUMB_WIDTH );
      $thumbResource = imagecreatetruecolor ( ARTICLE_THUMB_WIDTH, $thumbHeight );
      imagecopyresampled( $thumbResource, $imageResource, 0, 0, 0, 0, ARTICLE_THUMB_WIDTH, $thumbHeight, $imageWidth, $imageHeight );
 
      // Save the thumbnail
      switch ( $imageType ) {
        case IMAGETYPE_GIF:
          imagegif ( $thumbResource,  $this->getImagePath( IMG_TYPE_THUMB ) );
          break;
        case IMAGETYPE_JPEG:
          imagejpeg ( $thumbResource,  $this->getImagePath( IMG_TYPE_THUMB ), JPEG_QUALITY );
          break;
        case IMAGETYPE_PNG:
          imagepng ( $thumbResource,  $this->getImagePath( IMG_TYPE_THUMB ) );
          break;
        default:
          trigger_error ( "Article::storeUploadedImage(): Unhandled or unknown image type ($imageType)", E_USER_ERROR );
      }
	  
 
      /* $this->update(); */
    }
  }
  
  public function getImagePath( $type=IMG_TYPE_FULLSIZE ) {
    return ( $this->imageId && $this->imageExtension ) ? ( ARTICLE_IMAGE_PATH . "/$type/" . $this->imageFilename  ) : false;
  }
  
      public static function getById( $id ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM articles WHERE id = :id";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ( $row ) return new Article( $row );
	  }
	
	public static function getImageList( $numRows=1000000, $order="imageID DESC" ) {
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM resources
				ORDER BY " . $order . " LIMIT :numRows";
		
		$st = $conn->prepare( $sql );
		$st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
		$st->execute();
		$list = array();
	 
		while ( $row = $st->fetch() ) {
		  $resources = new Resources( $row );
		  $list[] = $resources;
		}
	 
		// Now get the total number of articles that matched the criteria
		$sql = "SELECT FOUND_ROWS() AS totalRows";
		$totalRows = $conn->query( $sql )->fetch();
		$conn = null;
		return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
	  }
	  

  
    public function insert() {
 
		// Does the Resource object already have an ID?
		if ( !is_null( $this->imageId ) ) trigger_error ( "Resources::insert(): Attempt to insert an Article object that already has its ID property set (to $this->imageId).", E_USER_ERROR );
	 
		// Insert the Article
		$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
		$sql = "INSERT INTO resources ( imageExtension, imageFilename, imageTitle) VALUES ( :imageExtension, :imageFilename, :imageTitle)";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":imageExtension", $this->imageExtension, PDO::PARAM_STR );
		$st->bindValue( ":imageFilename", $this->imageFilename, PDO::PARAM_STR );
		$st->bindValue( ":imageTitle", $this->imageTitle, PDO::PARAM_STR );
		$st->execute();
		$this->imageId = $conn->lastInsertId();
		$conn = null;
	  }
	}
?>