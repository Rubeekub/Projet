<h2>Annonces</h2>
  	
	<div class="loggin_annonces">
		<?php if (!$logged):?>
		<a class="button" href="?p=signup">Créer un compte</a>
		<a class="button" href="?p=signup">Se connecter</a>
		<?php else:;?>
		<img src="<?= getAvatar($_SESSION['id']) ?? 'img/defaut.jpg'?>">
		<a class="button" href="?p=deconnect">Se déconnecter</a>
		<?php endif;?>
	</div>
</div>

<div class="main">  	
	<input type="checkbox" id="annonce" aria-hidden="true">
	<div class="annonce">
		<form method="POST" action="" enctype="multipart/form-data">
			<label >Création de votre annonce</label>
			<input type="hidden" name="action" value="creation">
			<input type="text" name="titre" placeholder="Titre de l'annonce" required="">
			<input type="textaera" name="description" placeholder="Description de  l'annonce" required="">
			<input type="file" name="photo[]" accept="image/*" multiple>
			<button>Enregistrement</button>
		</form>
	</div>

</div>
		