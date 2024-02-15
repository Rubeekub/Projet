<?php
// récupére le chemin de la photo
function addAnnonce() {
    $titre=htmlspecialchars($_POST["titre"]);
    $description= htmlspecialchars($_POST["description"]);
    $date = date_create();
    $date_creation= date_timestamp_get($date);
        try {
            $db = connect();
            $query=$db->prepare('INSERT INTO annonces (titre, desciption, date_creation) VALUES (:titre, :desciption, :date_creation)');
            $query->execute(['titre'=> $titre, 'description'=> $description , 'date_creation'=> $date_creation]);
            if ($query->rowCount()){
                return array("success", "annonce postée!");
                }else array("error", "Problème lors de enregistrement");
            } catch (Exception $e) {
                return array("error",  $e->getMessage());
            } else array("error", "l'annonce n'a pas été postée");
}