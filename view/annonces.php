<h2>Annonces</h2>

<div class="main">  	
	<input type="checkbox" id="annonce" aria-hidden="true">
	<div class="annonce">
		<form method="POST" action="" enctype="multipart/form-data">
			<label for="chk" aria-hidden="true">Création de votre annonce</label>
			<input type="hidden" name="action" value="creation">
			<input type="text" name="titre" placeholder="Titre de l'annonce" required="">
			<input type="textaera" name="description" placeholder="Description de  l'annonce" required="">
			<input type="file" name="photo[]" accept="image/*" multiple>
			<button>Enregistrement</button>
		</form>
	</div>

</div>