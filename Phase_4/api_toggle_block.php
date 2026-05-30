<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once('fonctions.php');

// 1. SÉCURITÉ : Seul un administrateur a le droit d'appeler ce script
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["success" => false, "message" => "Accès interdit. Autorisation insuffisante."]);
    exit();
}

// 2. Lecture des données JSON envoyées par JavaScript
$fluxJson = file_get_contents('php://input');
$donneesRecues = json_decode($fluxJson, true);

if (!$donneesRecues || !isset($donneesRecues['id'])) {
    echo json_encode(["success" => false, "message" => "Identifiant de la cible manquant."]);
    exit();
}

$idCible = trim($donneesRecues['id']);

// Sécurité supplémentaire : On empêche l'admin de se bloquer lui-même par erreur
if ($idCible === $_SESSION['user_id']) {
    echo json_encode(["success" => false, "message" => "Action impossible : vous ne pouvez pas suspendre votre propre compte."]);
    exit();
}

// 3. Exécution du blocage / déblocage
$resultat = BlocageUtilisateur($idCible);

if ($resultat['success']) {
    echo json_encode([
        "success" => true,
        "est_bloque" => $resultat['est_bloque'],
        "message" => $resultat['est_bloque'] ? "Le compte a été suspendu." : "Le compte a été réactivé."
    ]);
} else {
    echo json_encode(["success" => false, "message" => "Utilisateur introuvable dans la base de données."]);
}
exit();