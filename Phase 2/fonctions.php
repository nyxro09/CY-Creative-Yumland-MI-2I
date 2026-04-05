<?php
// Bibliothèque de fonctions pour accéder aux données JSON

function getUtilisateurs() {
    $jsonString = file_get_contents('data/utilisateurs.json');
    return json_decode($jsonString, true); 
}

function getCatalogue() {
    $jsonString = file_get_contents('data/carte.json');
    return json_decode($jsonString, true);
}

function getPlats() {
    $catalogue = getCatalogue();
    return $catalogue['plats'];
}

function getMenus() {
    $catalogue = getCatalogue();
    return $catalogue['menus'];
}
// Fonction pour sauvegarder un nouvel utilisateur dans le JSON
function ajouterUtilisateur($nouvelUtilisateur) {
    $utilisateurs = getUtilisateurs();
    $utilisateurs[] = $nouvelUtilisateur;
    $jsonString = json_encode($utilisateurs, JSON_PRETTY_PRINT);
    file_put_contents('data/utilisateurs.json', $jsonString);
}

// Fonction pour mettre à jour tout le catalogue 
function sauvegarderCatalogue($nouveauCatalogue) {
    $jsonString = json_encode($nouveauCatalogue, JSON_PRETTY_PRINT);
    file_put_contents('data/carte.json', $jsonString);
}
?>