<?php
function getAllCategories() {
    try {
        $db = connect();
        //pas besoin de prepare car je n ai pas de paramettre donné par l utilisateur
        $query=$db->query('SELECT nom_categorie FROM categories');
        
            return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
$db= NULL;
$query=NULL;
}

function getOneCategories() {
    try {
        $db = connect();
        $query=$db->query('SELECT nom_categorie FROM categories WHERE id=id_annonce');
        
            return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    $db= NULL;
    $query=NULL;
}

function addCategorie() {
    $categorie=htmlspecialchars($_POST["nom_categories"]);
    try {
        $db = connect();
        $query=$db->prepare('INSERT INTO categories (nom_categorie) VALUES (:nom_categorie)');
        $query->execute(['nom_categories'=> $categorie]);
        if ($query->rowCount()){
            return array("success", "categories ajoutée!");
            }else array("error", "Problème lors de l'ajourt");
        } catch (Exception $e) {
            return array("error",  $e->getMessage());
        }     
$db= NULL;
$query= NULL;        
}

function modifCategorie() {
    $Categorie=htmlspecialchars($_POST["nom_categories"]);
    try {
        $db = connect();
        $query=$db->prepare('UPDATE categories SET nom_categorie = :nom_categorie WHERE id = :id_categorie');
        $query->execute(['categories'=> $categorie]);
        if ($query->rowCount()){
            return array("success", "categorie ajoutée!");
            }else array("error", "Problème lors de l'ajout");
        } catch (Exception $e) {
            return array("error",  $e->getMessage());
        }     
$db= NULL;
$query= NULL;        
}
?>
