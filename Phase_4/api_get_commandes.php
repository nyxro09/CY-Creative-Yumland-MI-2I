<?php session_start();
header('Content-Type: application/json; charset=utf-8');
require_once('fonctions.php');
$commandes=getCommandes();
$role = $_SESSION['role'] ?? '';
if ($role === 'livreur'){
    $commandes = array_filter($commandes, function($cmd) {
        return  $cmd['statut'] === 'prete' || ($cmd['statut'] === 'livraison' && ($cmd['livreur_id'] ?? '') === $_SESSION['user_id']);
    });
}
echo json_encode(array_values($commandes));
