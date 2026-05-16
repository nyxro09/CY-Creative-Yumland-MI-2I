<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once('fonctions.php');

// Seuls le restaurateur et le livreur peuvent modifier un statut
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['restaurateur', 'livreur'])) {
    echo json_encode(["success" => false, "message" => "Accès interdit. Droits insuffisants."]);
    exit();
}

// Lecture du flux JSON envoyé par le JavaScript (fetch)
$fluxJson = file_get_contents('php://input');
$donneesRecues = json_decode($fluxJson, true);

if (!$donneesRecues || !isset($donneesRecues['id']) || !isset($donneesRecues['statut'])) {
    echo json_encode(["success" => false, "message" => "Données de mise à jour manquantes."]);
    exit();
}

$idCommande = trim($donneesRecues['id']);
$nouveauStatut = trim($donneesRecues['statut']);

// Sécurité sur les statuts autorisés pour éviter les injections de données bizarres
$statutsAutorises = ['en_attente', 'preparation', 'prete', 'livraison', 'livre', 'abandonne'];
if (!in_array($nouveauStatut, $statutsAutorises)) {
    echo json_encode(["success" => false, "message" => "Statut de commande invalide."]);
    exit();
}

// modifie le fichier commandes.json
modifierStatutCommande($idCommande, $nouveauStatut);

echo json_encode([
    "success" => true,
    "id" => $idCommande,
    "statut" => $nouveauStatut,
    "message" => "Le statut de la commande a été mis à jour."
]);
exit();
?>