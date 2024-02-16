<h2>Annonces</h2>
 <!-- faire le formulaire, 
		traiter les donnees
		filtrer les données
		renvoyer a la BDD
-->
<div >
	<form method="POST" action="" enctype="multipart/form-data">
	<input type="hidden" name="action" value="addAnnonce">
		<label for="titre" >Titre de l'annonce</label>
		<input type="text" name="titre" placeholder="Titre de l'annonce" required <?= isset($annonces['titre']) ? htmlentities($annonces['titre'])  : '' ?>'>
		<label for="titre" >Description de l'annonce</label>
		<input type="textaera" name="description" placeholder="Description de  l'annonce" required <?= isset($annonces['description']) ? htmlentities($annonces['description'])  : '' ?>'>
		<label for="ville" >Lieux</label>
		<input type="text" name="ville" placeholder="Titre de l'annonce" required <?= isset($annonces['ville']) ? htmlentities($annonces['ville'])  : '' ?>'>
		<label for="prix_vente" >Prix</label>
		<input type="number" name="prix_vente" min=0 placeholder="prix" required <?= isset($annonces['prix_vente']) ? htmlentities($annonces['prix_vente'])  : '' ?>'>
<!--		<label for="photo_default" >Photo de l'annonce</label>
		<input type="file" name="photo_default" accept="image/*">
		<label for="photo_add" >Photos supplémentaire de l'annonce</label>
		<input type="file" name="photo_add[]" accept="image/*" multiple>
-->
		<button>Enregistrement</button>
	</form>
</div>