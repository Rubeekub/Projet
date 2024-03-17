<?php
// récupére le chemin de la photo
function addAnnonce() {
    $titre=htmlspecialchars($_POST["titre"]);
    $description= htmlspecialchars($_POST["description"]);
    $ville=htmlspecialchars($_POST["ville"]);
    $options = array(
        'options' => array(
            'min_range' => 0
        )
    );
    $prixvente=filter_var($_POST['prix_vente'],FILTER_SANITIZE_NUMBER_FLOAT, $options);

    echo $_POST['prix_vente'];
    echo $prixvente;
    try {
        $db = connect();
        $query=$db->prepare('INSERT INTO annonces (titre, description, ville, prix_vente, id_utilisateur) VALUES (:titre, :description, :ville, :prix_vente, :id)');
        $query->execute(['titre'=> $titre, 'description'=> $description, 'ville'=>$ville, 'prix_vente'=>$prixvente, 'id'=>$_SESSION['id']]);
        if ($query->rowCount()){
            return array("success", "annonce postée!");
            }else array("error", "Problème lors de enregistrement");
        } catch (Exception $e) {
            return array("error",  $e->getMessage());
        }     
$db= NULL;
$query= NULL;        
}
// enregistre les chemins des photos
function addPhotos($id) {
    $cpt=0;
    foreach($_FILES['photo']['error'] as $k=>$v){
        if(is_uploaded_file($_FILES['photo']['tmp_name'][$k]) && $v == UPLOAD_ERR_OK) { //faire var_dump si besoin
            $path="img/".$_FILES['photo']['name'][$k];
            move_uploaded_file($_FILES['photo']['tmp_name'][$k],$path);
            try{
                $db=connect();
                $query = $db->prepare("INSERT INTO photo( id_annonce, path ) VALUES (:id_annonce, :path)");
                $req= $query->execute(['id_annonce'=>$id,'path'=>$path]);
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
?>