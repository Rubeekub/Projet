<?php
include 'view/header.php';
include 'view/nav.php';

?>
<body>
    <div>
        <h1>Mes Petites annonces</h1>
        <?php 
$page= $_GET['p'] ?? ""; 

switch ($page) {
	case 'a_propos':
		include "view/a_propos.php";	
		break;	
    case 'contact':
        include "view/contact.php";	
		break;
    case 'mentions_legales':
        include "view/mentions_legales.php";	
    break;
    case 'immobilier':
        include "view/immobilier.php";	
    break;    
    case 'outils':
      include "view/outils.php";	
    break;
    case 'vehicules':
      include "view/vehicules.php";	
    break;
    case 'vetements':
      include "view/vetements.php";	
    break;
    default:
		include "view/home.php";
    }


include 'view/footer.php';
?>
</body>
</html>





