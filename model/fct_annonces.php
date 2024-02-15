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
                    }else array("error", "Problème lors de enregistrement");
                } catch (Exception $e) {
                    return array("error",  $e->getMessage());
                } 
            }else array("error", "Le mot de passe doit comporter au moins 8 caractères dont au moins 1 chiffre, 1 minuscule, 1 majuscule et 1 caractère spécial");
        }else array("error", "Les 2 saisies de mot de passes doivent être identique.");
    }else array("error", "Un compte existe déjà pour cet email.");
}
