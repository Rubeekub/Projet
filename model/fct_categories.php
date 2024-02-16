<?php
function getAllCategories() {
    try {
        $db = connect();
        //pas besoin de prepare car ce n est qu un select
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

?>
