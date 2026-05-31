<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once('fonctions.php');

// 1. Barrière de sécurité : seul un admin passe
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(["success" => false, "message" => "Accès non autorisé."]);
    exit();
}

$fluxJson = file_get_contents('php://input');
$donneesRecues = json_decode($fluxJson, true);

if (!$donneesRecues || !isset($donneesRecues['id']) || !isset($donneesRecues['role'])) {
    echo json_encode(["success" => false, "message" => "Données corrompues ou incomplètes."]);
    exit();
}

$idCible = trim($donneesRecues['id']);
$nouveauRole = trim($donneesRecues['role']);

// 2. Sécurité anti-suicide : un admin ne doit pas se dégrader lui-même par accident
if ($idCible === $_SESSION['user_id']) {
    echo json_encode(["success" => false, "message" => "Vous ne pouvez pas modifier votre propre rôle."]);
    exit();
}

// 3. Application de la modification
$resultat = modifierUtilisateurParId($idCible, 'role', $nouveauRole);

if ($resultat) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Utilisateur introuvable dans la base de données."]);
}
exit();
?>