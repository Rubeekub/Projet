<?php
// Création d'un bloc try/catch pour gérer les exceptions de la BDD
try {
    // Connection à la BDD
    $db = connect();

    $donneesperso = $db->query('SELECT pseudo, email, nom, prenom, date_naissance, numero_telephone, adresse_postale, code_postal, ville) FROM utilsateur WHERE id_utilsateur=$_SESSION["id"]');
    // Récupération de tous les membres et assignation à $members
    $member = $donneesperso->fetchAll(PDO::FETCH_ASSOC);;

} catch (Exception $e) {
    // Affiche le message en cas d'exception
    echo $e->getMessage();
}

// Fermeture de la connexion à la BDD
$db=null;
?>

    <h2>Membres</h2>
<div class='row'>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th scope='col'>pseudo</th>
                <th scope='col'>email</th>
                <th scope='col'>nom</th>
                <th scope='col'>prenom</th>
                <th scope='col'>date_naissance</th>
                <th scope='col'>numero_telephone</th>
                <th scope='col'>adresse_postale</th>
                <th scope='col'>code_postale</th>
                <th scope='col'>ville</th>
                <th scope='col'>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($member as $k) : ?>
                <tr>
                <td><?= htmlentities($member['pseudo']) ?></td>
                <td><?= htmlentities($member['email']) ?></td>
                    <td><?= htmlentities($member['nom']) ?></td>
                    <td><?= htmlentities($member['prenom']) ?></td>
                    <td><?= htmlentities($member['date_naissance']) ?></td>
                    <td><?= htmlentities($member['numero_telephone']) ?></td>
                    <td><?= htmlentities($member['adresse_postale']) ?></td>
                    <td><?= htmlentities($member['code_postal']) ?></td>
                    <td><?= htmlentities($member['ville']) ?></td>
                    <td>
                        <a class='btn btn-primary' href='member-form.php?id=<?= $member['id'] ?>' role='button'>Modifier</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
?>