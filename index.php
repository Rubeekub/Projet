<?php
include 'header.php';
include 'nav.php';
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
    default:
		include "view/home.php";
    }


include 'footer.php';
?>
</body>
</html>





