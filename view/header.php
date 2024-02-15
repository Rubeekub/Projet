<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trouve Tout</title>
      <!--
        <link rel="stylesheet" href="assets/css/style.css">
-->
    </head>
<body>
<?php if (!empty($message)) : ?>
    <div class='row'>
        <div class='alert alert-<?=$message[0]?>'>
            <?= $message[1] ?>
        </div>
    </div>
<?php endif; ?> 