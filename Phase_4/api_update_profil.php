<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once('fonctions.php');

// 1.On vérifie que l'utilisateur possède bien une session active
if (!isset($_SESSION['email'])) {
    echo json_encode(["success" => false, "message" => "Accès refusé. Session expirée ou inexistante."]);
    exit();
}

// 2. Lecture du flux JSON asynchrone envoyé par le JavaScript (fetch)
$fluxJson = file_get_contents('php://input');
$donneesRecues = json_decode($fluxJson, true);

// 3. Validation des données arrivées sur le serveur
if (!$donneesRecues || !isset($donneesRecues['champ']) || !isset($donneesRecues['valeur'])) {
    echo json_encode(["success" => false, "message" => "Données de modification manquantes ou corrompues."]);
    exit();
}

$champAModifier = trim($donneesRecues['champ']);
$nouvelleValeur = trim($donneesRecues['valeur']);

// Sécurité sur les champs autorisés 
$champsAutorises = ['nom', 'prenom', 'email', 'adresse', 'role'];
if (!in_array($champAModifier, $champsAutorises)) {
    echo json_encode(["success" => false, "message" => "Modification de ce champ non autorisée."]);
    exit();
}

// 4. On lance la modification dans le fichier JSON
$succesFichier = modifierUtilisateur($_SESSION['email'], $champAModifier, $nouvelleValeur);

if ($succesFichier) {
    // Si la modification du JSON a marché, on met à jour la session 
    $_SESSION[$champAModifier] = $nouvelleValeur;
    
    echo json_encode([
        "success" => true, 
        "message" => "Mise à jour effectuée avec succès.",
        "champ" => $champAModifier,
        "valeur" => $nouvelleValeur
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Erreur lors de l'écriture dans la base de données."]);
}
exit();
