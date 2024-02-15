<?php
// récupére le chemin de la photo
function addAnnonce() {
    $titre=htmlspecialchars($_POST["titre"]);
    $description= htmlspecialchars($_POST["description"]);
    $ville=htmlspecialchars($_POST["ville"]);
    echo $_SESSION['id'];
    echo "ville".$ville."titre".$titre."description".$description;
        try {
            $db = connect();
            $query=$db->prepare('INSERT INTO annonces (titre, description, ville, id_utilisateur) VALUES (:titre, :description, :ville, :id)');
            $query->execute(['titre'=> $titre, 'description'=> $description, 'ville'=>$ville, 'id'=>$_SESSION['id']]);
            if ($query->rowCount()){
                return array("success", "annonce postée!");
                }else array("error", "Problème lors de enregistrement");
            } catch (Exception $e) {
                return array("error",  $e->getMessage());
            }             
}

/*
<?php 
if ($_SESSION){
try {
    // Connection à la BDD
    $db = connect();
    // Création de $annoncesQuery. On utilise inner join 
    $MesAnnoncesQuery = $db->query('SELECT titre, description, photos FROM annonces  AS a INNER JOIN utilisateurs AS u ON id_utlisateur.a = id_utlisateur.u');
    // Récupération de toutes les annonces et assignation à $annonces
    $annonces = $MesAnnoncesQuery->fetchAll(PDO::FETCH_ASSOC);;
} catch (Exception $e) {
    // Affiche le message en cas d'exception
    echo $e->getMessage();
}
// Fermeture de la connexion à la BDD
$db=null;
}else echo 'Veuillez-vous connecter!';
?>

<h2>Annonces</h2>
 <!-- faire le formulaire, 
		traiter les donnees
		filtrer les données
		renvoyer a la BDD
-->
<?php
try {
    // Récupération des annonces avec la fonctions getAnnonces
 $annonces=getAannonces();
} catch (Exception $e) {
    // Afficher le message en cas d'envoi d'exception
    echo $e->getAnnonces();
}
?>

</div>
<div class='row'>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th scope='col'>titre</th>
                <th scope='col'>description</th>
                <th scope='col'>Photos</th>
                <th scope='col'>categories</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($annonces as $annonce) : ?>
                <tr>
                    <td><?= $annonces['id'] ?></td>
                    <td><?= htmlentities($annonces['titre']) ?></td>
                    <td><?= htmlentities($annonces['description']) ?></td>
                    <td><?= htmlentities($annonces['photos']) ?></td>
                    <td><?= htmlentities($annonces['categories']) ?></td>
                    <td>
                        <a class='btn btn-primary' href='annonces-form.php?id=<?= $annonces['id'] ?>' role='button'>Modifier</a>
                        <a class='btn btn-danger' href='delete-annonces.php?id=<?= $annonces['id'] ?>' role='button'>Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
        <a class='btn btn-success' href='member-form.php' role='button'>Ajouter annonce</a>
</div>

*/