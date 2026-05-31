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


// Fonction pour modifier une information spécifique d'un utilisateur rétrospectivement
function modifierUtilisateur($email, $champ, $valeur) {
    $utilisateurs = getUtilisateurs();
    $modifie = false;

    foreach ($utilisateurs as &$user) {
        // On cherche l'utilisateur par son email unique
        if (isset($user['email']) && $user['email'] === $email) {
            $user[$champ] = $valeur;
            $modifie = true;
            break;
        }
    }

    // Si on a trouvé et modifié l'utilisateur, on remet le JSON à jour
    if ($modifie) {
        $jsonString = json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('data/utilisateurs.json', $jsonString);
        return true;
    }
    
    return false;
}

// Fonction pour bloquer ou débloquer un utilisateur
function BlocageUtilisateur($id) {
    $utilisateurs = getUtilisateurs();
    $modifie = false;
    $nouveauStatut = false;

    foreach ($utilisateurs as &$user) {
        if (isset($user['id']) && $user['id'] === $id) {
            // Si la clé n'existe pas encore, on l'initialise à true (bloqué), sinon on inverse
            $user['est_bloque'] = !($user['est_bloque'] ?? false);
            $nouveauStatut = $user['est_bloque'];
            $modifie = true;
            break;
        }
    }

    if ($modifie) {
        $jsonString = json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('data/utilisateurs.json', $jsonString);
        return [
            "success" => true,
            "est_bloque" => $nouveauStatut
        ];
    }

    return ["success" => false];
}


function modifierUtilisateurParId($id, $champ, $valeur) {
    $utilisateurs = getUtilisateurs();
    $modifie = false;

    foreach ($utilisateurs as &$user) {
        if (isset($user['id']) && $user['id'] === $id) {
            $user[$champ] = $valeur;
            $modifie = true;
            break;
        }
    }

    if ($modifie) {
        $jsonString = json_encode($utilisateurs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('data/utilisateurs.json', $jsonString);
        return true;
    }
    return false;
}
