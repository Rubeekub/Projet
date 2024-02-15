<h2>site convivial</h2>

<div class="main">  	
	<div class="home">
		<?php if (!$logged):?>
		<a class="button" href="<?=CHEMIN?>?p=signup">Créer un compte</a>
		<a class="button" href="<?=CHEMIN?>?p=signup">Se connecter</a>
		<?php else:;?>
		<img src="<?= getAvatar($_SESSION['id']) ?? 'img/defaut.jpg'?>" height=100>
		<a class="button" href="<?=CHEMIN?>?p=deconnect">Se déconnecter</a>
		<a class="button" href="<?=CHEMIN?>?p=annonces">Gérer mes annonces</a>
		<?php endif;?>
	</div>
</div>
