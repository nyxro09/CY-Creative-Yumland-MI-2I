<?php
session_start();

require_once('fonctions.php');
if (isset($_SESSION['email'])) {
    $utilisateurs = getUtilisateurs();
    foreach($utilisateurs as $user) {
        if ($user['email'] === $_SESSION['email'] && !empty($user['est_bloque'])) {
            echo json_encode(["success" => false, "message" => "Votre compte est suspendu."]);
            exit();
        }
    }
}

header('Content-Type: application/json; charset=utf-8');

// Initialisation du panier si inexistant
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Lecture des données envoyées par JavaScript
$fluxJson = file_get_contents('php://input');
$donneesRecues = json_decode($fluxJson, true);

if (!$donneesRecues || !isset($donneesRecues['id']) || !isset($donneesRecues['nom']) || !isset($donneesRecues['prix'])) {
    echo json_encode(["success" => false, "message" => "Données de l'article manquantes."]);
    exit();
}

$id = trim($donneesRecues['id']);
$nom = trim($donneesRecues['nom']);
$prix = floatval($donneesRecues['prix']);

// Ajout ou incrémentation dans la session
if (isset($_SESSION['panier'][$id])) {
    $_SESSION['panier'][$id]['quantite']++;
} else {
    $_SESSION['panier'][$id] = [
        'id'       => $id,
        'nom'      => $nom,
        'prix'     => $prix,
        'quantite' => 1,
    ];
}

// Réponse JSON de succès
echo json_encode([
    "success" => true,
    "message" => "Article ajouté avec succès."
]);
exit();
?>
