<?php
// Connection à la base de données et renvoie l'objet PDO
function connect() {
    // hôte
    $hostname = 'localhost';

    // nom de la base de données
    $dbname = 'projet_annonces';

    // identifiant et mot de passe de connexion à la BDD
    $username = 'root';
    $password = '';
    
    // Création du DSN (data source name) en combinant le type de BDD, l'hôte et le nom de la BDD
    $dsn = "mysql:host=$hostname;dbname=$dbname";

    // Tentative de connexion avec levée d'une exception en cas de problème
    try{
      return new PDO($dsn, $username, $password);
    } catch (Exception $e){
      echo $e->getMessage();
    }
$db= NULL;
$query=NULL;
}

// Récupération d'un utilisateur à partir de son email
function getUserByEmail($email) {
    try {
        $db = connect();
        $query=$db->prepare('SELECT * FROM utilisateurs WHERE email= :email');
        $query->execute(['email'=>$email]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 
    return false;
$db= NULL;
$query=NULL;
}   

// Récupération d'un utilisateur à partir d'un token
function getUserByToken($token) {
    try {
        $db = connect();
        $query=$db->prepare('SELECT * FROM utilisateurs WHERE token= :token');
        $query->execute(['token'=>$token]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 
    return false;
$db= NULL;
$query=NULL;    
}   

// Récupération d'un utilisateur à partir d'un id
function getUserById($id) {
    try {
        $db = connect();
        $query=$db->prepare('SELECT * FROM utilisateurs WHERE id= :id');
        $query->execute(['id'=>$id]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 
    return false;
$db= NULL;
$query=NULL;
}

// récupére le chemin de l'avatar
function getAvatar($id) {
    try {
        $db = connect();
        $query=$db->prepare('SELECT path FROM avatars WHERE id_utilisateur = :id');  //placeholder id
        $query->execute(['id'=>$id]);
        if ($query->rowCount()){
            $avatars=$query->fetchAll(PDO::FETCH_COLUMN,0);
            return $avatars[random_int(0,count($avatars)-1)];
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 
    return false;
$db= NULL;
$query=NULL;
}

// enregistre les chemins des avatars
function addAvatar($id) {
    $cpt=0;
    foreach($_FILES['avatar']['error'] as $k=>$v){
        if(is_uploaded_file($_FILES['avatar']['tmp_name'][$k]) && $v == UPLOAD_ERR_OK) { //$v c est pareil que $_FILES['avatar']['error']["$k"], faire var_dump
            $path="img/".$_FILES['avatar']['name'][$k];
            move_uploaded_file($_FILES['avatar']['tmp_name'][$k],$path);
            try{
                $db=connect();
                $query = $db->prepare("INSERT INTO avatars( id_utilisateur, path ) VALUES (:id_utilisateur, :path)");
                $req= $query->execute(['id_utilisateur'=>$id,'path'=>$path]);
                if($req) $cpt++;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }else echo 'erreur fichier'; // erreur du longeur de nom de fichier modifiée en passant de 50 a 250 varchar dans la BDD
    }
    return $cpt;
$db= NULL;
$query=NULL;
}

function addUser() {
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    if(!getUserByEmail($email)){
        if ($_POST['pwd']===$_POST['pwd2']){
            if(preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd'])){
                $pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                $nom=htmlspecialchars($_POST['nom']);
                $token=bin2hex(random_bytes(16));
                try {
                    $db = connect();
                    $query=$db->prepare('INSERT INTO utilisateurs (email, nom, password, token) VALUES (:email, :nom, :pwd, :token)');
                    $query->execute(['email'=> $email, 'nom'=> $nom , 'pwd'=> $pwd, 'token'=> $token]);
                    if ($query->rowCount()){
                        $nb=addAvatar($db->lastInsertId());
                        $content="<p><a href='http://localhost/Petites_annonces/?p=activation&t=$token'>Merci de cliquer sur ce lien pour activer votre compte</a></p>";
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        $headers = array(
                            'MIME-Version' => '1.0',
                            'Content-type' => 'text/html; charset=iso-8859-1',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );
                        mail($email,"Veuillez activer votre compte", $content, $headers);
                        return array("success", "Inscription réussi. Vous avez déjà $nb avatars. Vous allez recevoir un mail pour activer votre compte");
                    }else return array("error", "Problème lors de enregistrement");
                } catch (Exception $e) {
                    return array("error",  $e->getMessage());
                } 
            }else return array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
        }else return array("error", "Les 2 saisies de mot de passes doivent être identique.");
    }else return array("error", "Un compte existe déjà pour cet email.");
$db= NULL;
$query=NULL;
}

function logUser() {
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    $user=getUserByEmail($email);
    if($user){
        if(password_verify($_POST['pwd'], $user['password'])){
            if($user['actif']){
                $_SESSION['is_login']=true;
                $_SESSION['is_actif']=$user['actif'];
                $_SESSION['id']=$user['id_utilisateur'];
                return array("success", "Connexion réussie :)");               
            }else return array("error", "Veuillez activer votre compte");
        }else return array("error", "Mauvais identifiants");
    }else return array("error", "Mauvais identifiants");
}

function activUser() {
    $token=htmlspecialchars($_GET['t']);
    $user=getUserByToken($token);
    if($user){
        if(!$user['actif']){
            try {
                $db = connect();
                $query=$db->prepare('UPDATE utilisateurs SET token = NULL, actif = 1 WHERE token= :token');
                    $query->execute(['token'=> $token]);
                    if ($query->rowCount()){
                         return array("success", "Votre compte est activé, vous pouvez vous connecter"); 
                    }else return array("error", "Problème lors de l'activation"); 
            } catch (Exception $e) {
                return array("error",  $e->getMessage());
            }              
        }else return array("error", "Ce compte est déjà actif");
    }else return array("error", "Lien invalide !");
$db= NULL;
$query=NULL;
}

function waitReset() {
    $email=filter_var(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
    if(getUserByEmail($email)){
        $token=bin2hex(random_bytes(16));
        $perim=time()+1200;
        try {
            $db = connect();
            $query=$db->prepare('UPDATE utilisateurs SET token = :token, perim = :perim WHERE email = :email');
            $query->execute(['email'=> $email, 'perim'=> $perim , 'token'=> $token]);
            if ($query->rowCount()){
                $content="<p><a href='http://localhost/Petites_annonces/?p=reset&t=$token'>Merci de cliquer sur ce lien pour réinitialiser votre mot de passe</a></p>";
                // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                $headers = array(
                    'MIME-Version' => '1.0',
                    'Content-type' => 'text/html; charset=iso-8859-1',
                    'X-Mailer' => 'PHP/' . phpversion()
                );
                mail($email,"Réinitialisation de mot de passe", $content, $headers);
                return array("success", "Vous allez recevoir un mail pour réinitialiser votre mot de passe".$content);
            }else array("error", "Problème lors du process de réinitialisation");
        } catch (Exception $e) {
            return array("error",  $e->getMessage());
        }
    }else array("error", "Aucun compte ne correspond à cet email.");
$db= NULL;
$query=NULL;
}

function resetPwd() {
    $token=htmlspecialchars($_POST['token']);
    $user=getUserByToken($token);
    if($user){
        if ($_POST['pwd']===$_POST['pwd2']){
            if(preg_match("/^(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{8,}$/", $_POST['pwd'])){
                $pwd=password_hash($_POST['pwd'], PASSWORD_DEFAULT);
                try {
                    $db = connect();
                    $query=$db->prepare('UPDATE utilisateurs SET token = NULL, password = :pwd, actif = 1 WHERE token= :token');
                    $query->execute(['pwd'=> $pwd, 'token'=> $token]);
                    if ($query->rowCount()){
                        $content="<p>Votre mot de passe a été réinitialisé</p>";
                        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
                        $headers = array(
                            'MIME-Version' => '1.0',
                            'Content-type' => 'text/html; charset=iso-8859-1',
                            'X-Mailer' => 'PHP/' . phpversion()
                        );
                        mail($user['email'],"Réinitialisation de mot de passe", $content, $headers);
                        return array("success", "Votre mot de passe a bien été réinitialisé");
                    }else array("error", "Problème lors de la réinitialisation");
                } catch (Exception $e) {
                    return array("error",  $e->getMessage());
                } 
            }else array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
        }else array("error", "Les 2 saisies de mot de passe doivent être identiques.");
    }else return array("error", "Les données ont été corrompues ! Veuillez <a href='?p=forgot'>recommencer</a>");
     $query = null;
     $db = null;
}
