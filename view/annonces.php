<h2>Annonces</h2>
 <!-- faire le formulaire, 
		traiter les donnees
		filtrer les données
		renvoyer a la BDD
-->
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