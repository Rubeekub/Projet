<h2>site convivial</h2>

<div class="main">  	
	<div class="home">
		<?php if (!$logged):?>
		<a class="button" href="?p=signup">Créer un compte</a>
		<a class="button" href="?p=signup">Se connecter</a>
		<?php else:;?>
		<img src="<?= getAvatar($_SESSION['id']) ?? 'img/defaut.jpg'?>" height=100>
		<a class="button" href="?p=deconnect">Se déconnecter</a>
		<?php endif;?>
	</div>
</div>
