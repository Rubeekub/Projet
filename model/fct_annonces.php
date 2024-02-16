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
?>