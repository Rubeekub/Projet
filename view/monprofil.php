<?php

require_once 'functions.php';

if (!empty($_POST)) {
    $pseudo= $_POST['pseudo'] ?? '';
    $nom= $_POST['nom'] ?? '';
    $prenom= $_POST['prenom'] ?? '';
    $date_naissance= $_POST['date_naissance'] ?? '';
    $num_telephone= $_POST['num_telephone'] ?? '';
    $adresse_postale= $_POST['adresse_postale'] ?? '';
    $code_postal= $_POST['$code_postal'] ?? '';
    $ville= $_POST['ville'] ?? '';
    $niv_administration = $_POST['niv_administration'] ?? '';

    
    //filter_input( ..., '...', FILTER_SANITIZE_NUMBER_INT);

    // Connection à la BDD avec la fonction connect() dans functions.php
    $db = connect();

    // Un membre n'a un ID que si ses infos sont déjà enregistrées en BDD, donc on vérifie s'il  le membre a un ID.
    if (empty($_POST['id'])) {
         // S'il n'y a pas d'ID, le membre n'existe pas dans la BDD donc on l'ajoute.
         try {
            // Préparation de la requête d'insertion.
            $createMemberStmt = $db->prepare('INSERT INTO utilisateurs (pseudo, nom, prenom, date_naissance, num_telephone, adresse_postale, code_postal, ville, niv_administration) VALUES (:pseudo, :nom, :prenom, :date_naissance, :num_telephone, :adresse_postale, :code_postal, :ville, :niv_administration)';
            // Exécution de la requête
            $createMemberStmt->execute(['pseudo'=>$pseudo, 'nom'=>$nom, 'prenom'=>$prenom, 'date_naissance'=>$date_naissance, 'num_telephone'=>$num_telephone, 'adresse_postale'=>$adresse_postale, 'code_postal'=>$code_postal, 'ville'=>$ville, 'niv_administration'=>$niv_administration]);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($createMemberStmt->rowCount()) {
                // Une ligne a été insérée => message de succès
                $type = 'success';
                $message = 'Mise a jour effectuée';
            } else {
                // Aucune ligne n'a été insérée => message d'erreur
                $type = 'error';
                $message = 'Modification non prise en compte';
            }
        } catch (Exception $e) {
            // Le membre n'a pas été ajouté, récupération du message de l'exception
            $type = 'error';
            $message = 'Modification non prise en compte: ' . $e->getMessage();
        }
    } else {
        // Le membre existe, on met à jour ses informations

        // Récupération de l'ID du membre de facon securisée
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        // Mise à jour des informations du membre
        try {
            // Préparation de la requête de mis à jour (donc modification de la base de données) (dans SET: noms dans BDD , :prenom doit etre identique a $prenom dans le fichier)
            $updateMemberStmt = $db->prepare('UPDATE utilisateurs SET pseudo=:pseudo, nom=:nom, prenom=:prenom, date_naissance=:date_naissance, num_telephone=:num_telephone, adresse_postale=:adresse_postale, code_postal=:code_postal, ville=:ville, niv_administration=:niv_administration WHERE id=:id');

            // Exécution de la requête
           $updateMemberStmt->execute(['pseudo'=>$pseudo, 'nom'=>$nom, 'prenom'=>$prenom, 'date_naissance'=>$date_naissance, 'num_telephone'=>$num_telephone, 'adresse_postale'=>$adresse_postale, 'code_postal'=>$code_postal, 'ville'=>$ville, 'niv_administration'=>$niv_administration]);
            // Vérification qu'une ligne a bien été impactée avec rowCount(). Si oui, on estime que la requête a bien été passée, sinon, elle a sûrement échoué.
            if ($updateMemberStmt->rowCount()) {
                // Une ligne a été mise à jour => message de succès
                $type = 'success';
                $message = 'Membre mis à jour';
            } else {
                // Aucune ligne n'a été mise à jour => message d'erreur
                $type = 'error';
                $message = 'Membre non mis à jour';
            }
        } catch (Exception $e) {
            // Une exception a été lancée, récupération du message de l'exception
            $type = 'error';
            $message = 'Membre non mis à jour: ' . $e->getMessage();
        }
    }

    // Fermeture des connexions à la BDD
    $createMemberStmt = null;
    $updateMemberStmt = null;
    $db = null;

    // Redirection vers la page principale des membres en passant le message et son type en variables GET
    header('location:' . 'members.php?type=' . $type . '&message=' . $message);
}

?>