<?php
define("URL","http://localhost/Petites_annonces/");
include 'view/header.php';
include 'view/nav.php';

session_start();
require_once "model/functions.php";
require_once "model/fct_annonces.php";

?>
<body>
    <div>
        <h1>Mes Petites annonces</h1>
        <?php 
$page= $_GET['p'] ?? ""; 

if($_SERVER["REQUEST_METHOD"] === "POST"){
  $action= $_POST['action'] ?? "";
  switch ($action){
    case 'signup':
      $message=addUser();
      break;
    case 'login':
      $message=logUser();
      $page="home";
      break;
    case 'forgot':
      $message=waitReset();
      $page="home";
      break;
    case 'reset':
      $message=resetPwd();
      $page="signup";
      case 'addAnnonce':
        $message=addAnnonce();
        break;
  }
}

if ($page=='activation')
        $message=activUser();
    if ($page=='deconnect'){
      session_unset();
      session_destroy();
      $message=array("success", "Vous êtes déconnecté");
    }
    if ($page=='reset' && !isset($_GET['t'])){
      $message=array("error", "Lien invalide. Veuillez réessayer");
      $page="forgot";
    }
    
    $logged = $_SESSION['is_login'] ?? false;
    
include "view/header.php";
switch ($page) {  
  case 'forgot':
    include "view/forgot.php";	
    break;	
  case 'reset':
    $token=htmlspecialchars($_GET['t']);// 't' créé par le mail d activation en GET
    include "view/reset.php";	
    break;	
  case 'signup':
    include "view/signup.php";	
    break;
  case 'a_propos':
    include "view/a_propos.php";	
    break;
  case 'contact':
    include "view/contact.php";	
    break;
  case 'annonces':
      include "view/annonces.php";	
      break;
  case 'mentions_legales':
    include "view/mentions_legales.php";	
    break;	
  default:
    include "view/home.php";	
    }

    // recerche de l erreur

include "view/footer.php";

?>
</body>
</html>





