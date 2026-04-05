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

// Fonction pour récupérer les commandes faites sur le site
function getCommandes(){
    $jsonString = file_get_contents('data/commandes.json');
    return json_decode($jsonString, true);
}

// Fonction pour ajouter une nouvelle commande
function ajouterCommande($nouvelleCommande){
    $commandes = getCommandes();
    $commandes[] = $nouvelleCommande;
    $jsonString = json_encode($commandes, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
    file_put_contents('data/commandes.json', $jsonString);
}

//Fonction pour modifier le statut d'une commande
function modifierStatutCommande($id, $nouveauStatut) {
    $commandes = getCommandes();
    foreach ($commandes as &$commande) {
        if ($commande['id'] === $id) {
            $commande['statut'] = $nouveauStatut;
            break;
        }
    }
    $jsonString = json_encode($commandes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents('data/commandes.json', $jsonString);
}
?>
?>

