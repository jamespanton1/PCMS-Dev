<?php
 
require( "config.php" );
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    $results['errorMessage'] = "You have been timed out. Please log in again";
	unset( $_SESSION['username'] );
    session_destroy();   // destroy session data in storage
	
}



$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";
 
if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}
 
switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
  case 'listArticle':
    listArticle();
    break;
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
  case 'listResources':
    listResources();
    break;
  case 'newResource':
    newResource();
    break;
  case 'listResourcesPick':
	listResourcesPick();
	break;
  case 'editResource':
    editResource();
    break;
  default:
    listArticles();
}
 
 
function login() {
 
  $results = array();
  $results['pageTitle'] = "Admin Login | Widget News";
 
  if ( isset( $_POST['login'] ) ) {
 
    // User has posted the login form: attempt to log the user in
    $uname = $_POST['username'];
	$upass = $_POST['password'];
  
	$uname = strip_tags(trim($uname));
	$upass = strip_tags(trim($upass));
	
	$password = hash('sha256', $upass);
	
	$conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT userPass FROM users WHERE userName = '$uname'";
	$st = $conn->prepare( $sql );
	$st->execute();
	$getuserpass = $st->fetchColumn();
	
/* 	$conn->exec("INSERT INTO `users`(`userName`, `userPass`)
    VALUES ('$uname', '$upass')");
	$stmt = $conn->prepare("SELECT userName FROM users"); 
	$testid= $stmt->execute();
	$stmt->closeCursor();
	$getuserid = $conn->exec("SELECT userId FROM users WHERE userName = '$uname'");
	$getuser = $conn->exec("SELECT userName FROM users WHERE userId = '$getuserid'");
	$getuserpass = $conn->exec("SELECT userPass FROM users WHERE userId = '$getuserid'"); */
	
	
	if ( $password == $getuserpass ) {
 
      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" );
 
    } else {
 
      // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }
	
	$conn = null;
 
  } else {
 
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
 
}
 
 
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}
 
 
function newArticle() {
 
  $results = array();
  $results['pageTitle'] = "New Article";
  $results['formAction'] = "newArticle";
 
  if ( isset( $_POST['saveChanges'] ) ) {
	  
	 
    // User has posted the article edit form: save the new article
    $article = new Article;
    $article->storeFormValues( $_POST );
    $article->insert();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['article'] = new Article;
    $data = Resources::getImageList();
    $results['images'] = $data['results'];
      
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }
 
}



function newResource() {
 
  $results = array();
  $results['pageTitle'] = "New Resource";
  $results['formAction'] = "newResource";
 
  if ( isset( $_POST['uploadResource'] ) ) {
 
    // User has posted the upload resource form: save the new resource
    global $resources;
	$resources = new Resources;
    $combinedPost = array_merge( $_POST, $_FILES);
	$resources->storeFormValues( $combinedPost );
    /* $resources->insert(); */
	$resources->insert( $resources );
	$filteredFileName = $resources->filterFileName($_FILES['imagePathFull']);
	/* var_dump($filteredFileName); */
	if ( isset( $_FILES['imagePathFull'] ) ) $resources->storeUploadedImage( $filteredFileName );
    header( "Location: admin.php?action=listResources" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=listResources" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['resources'] = new Resources;
    require( TEMPLATE_PATH . "/admin/editResource.php" );
  }
 
}
 
 
function editArticle() {
 
  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the article changes
 
    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin.php?error=articleNotFound" );
      return;
    }
 
    $article->storeFormValues( $_POST );
    $article->update();
    header( "Location: admin.php?status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {
    // User has not posted the article edit form yet: display the form
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    $data = Resources::getImageList();
    $results['images'] = $data['results'];
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }
 
}

function editResource() {
 var_dump(headers_sent());
  $results = array();
  $results['pageTitle'] = "New Resource";
  $results['formAction'] = "newResource";
 
  if ( isset( $_POST['editResource'] ) ) {
	  
	
 
    // User has posted the upload resource form: save the new resource
    global $resources;
	$resources = new Resources;
    $combinedPost = array_merge( $_POST, $_FILES);
	$resources->storeFormValues( $combinedPost );
    /* $resources->insert(); */
	$resources->insert( $resources );
	$filteredFileName = $resources->filterFileName($_FILES['imagePathFull']);
	
	if ( isset( $_FILES['imagePathFull'] ) ) $resources->storeUploadedImage( $filteredFileName );
    header( "Location: admin.php?action=listResources" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=listResources" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['resources'] = new Resources;
    require( TEMPLATE_PATH . "/admin/editResource.php" );
  }
 
}
 
 
function deleteArticle() {
 
  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?error=articleNotFound" );
    return;
  }
 
  $article->delete();
  header( "Location: admin.php?status=articleDeleted" );
}

function listResources() {
  $results = array();
  $results['pageTitle'] = "Resources";
 
  $results['formAction'] = "listResource";
  $data = Resources::getImageList();
  $results['resources'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  /* $results['pageTitle'] = "All Articles"; */
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSavedResources" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
  require( TEMPLATE_PATH . "/admin/resourceDashboard.php" );
}

function listResourcesPick() {
  $results['pageTitle'] = "New Resource";
  $results['formAction'] = "listResource";
 
/*   global $resources;
  echo var_dump($resources); */
  $results = array();
  $data = Resources::getImageList();
  $results['resources'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  /* $results['pageTitle'] = "All Articles"; */
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSavedResources" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
  require( TEMPLATE_PATH . "/admin/resourcePick.php" );
}
 
 
function listArticles() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "All Articles";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/dashboard.php" );
}
 
?>