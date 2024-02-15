<h2>Annonces</h2>
 <!-- faire le formulaire, 
		traiter les donnees
		filtrer les données
		renvoyer a la BDD
-->
<?php 
if ($_SESSION){
try {
    // Connection à la BDD
    $db = connect();
    // Création de $annoncesQuery. On utilise inner join 
    $MesAnnoncesQuery = $db->query('SELECT titre, description, photos FROM annonces  AS a INNER JOIN utilisateurs AS u ON id_utlisateur.a = id_utlisateur.u');
    // Récupération de toutes les annonce et assignation à $annonces
    $annonces = $MesAnnoncesQuery->fetchAll(PDO::FETCH_ASSOC);;
} catch (Exception $e) {
    // Affiche le message en cas d'exception
    echo $e->getMessage();
}
// Fermeture de la connexion à la BDD
$db=null;
}else echo 'Veuillez-vous connecter!';
?>

<?php if (!empty($_GET['type']) && ($_GET['type'] === 'success')) : ?>
    <div class='row'>
        <div class='alert alert-success'>
            Succès! <?= $_GET['message'] ?>
        </div>
    </div>
<?php elseif (!empty($_GET['type']) && ($_GET['type'] === 'error')) : ?>
    <div class='row'>
        <div class='alert alert-danger'>
            Erreur! <?= $_GET['message'] ?>
        </div>
    </div>
<?php endif; ?>
<div class='row'>
    <h1 class='col-md-12 text-center border border-dark text-white bg-primary'>Membres</h1>
</div>
<div class='row'>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th scope='col'>#</th>
                <th scope='col'>Prénom</th>
                <th scope='col'>Nom</th>
                <th scope='col'>Adresse</th>
                <th scope='col'>Abo</th>
                <th scope='col'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member) : ?>
                <tr>
                    <td><?= $member['id'] ?></td>
                    <td><?= htmlentities($member['prenom']) ?></td>
                    <td><?= htmlentities($member['nom']) ?></td>
                    <td><?= htmlentities($member['adresse']) ?></td>
                    <td><?= htmlentities($member['titre']) ?></td>
                    <td>
                        <a class='btn btn-primary' href='member-form.php?id=<?= $member['id'] ?>' role='button'>Modifier</a>
                        <a class='btn btn-danger' href='delete-member.php?id=<?= $member['id'] ?>' role='button'>Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class='row'>
    <div class='col'>
        <a class='btn btn-success' href='member-form.php' role='button'>Ajouter membre</a>
    </div>
</div>

<?php require_once 'footer.php' ?>
<div >
	<form method="POST" action="" enctype="multipart/form-data">
		<label for="titre" >Titre de l'annonce</label>
		<input type="text" name="titre" placeholder="Titre de l'annonce" required="">
		<label for="titre" >Description de l'annonce</label>
		<input type="textaera" name="description" placeholder="Description de  l'annonce" required="">
		<label for="photo_default" >Photo de l'annonce</label>
		<input type="file" name="photo_default" accept="image/*">
		<label for="photo_add" >Photos supplémentaire de l'annonce</label>
		<input type="file" name="photo_add[]" accept="image/*" multiple>
		<button>Enregistrement</button>
	</form>
</div>