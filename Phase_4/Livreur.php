<?php 
include('header.php'); 
require_once('fonctions.php');

// Seul le livreur peut accéder à cette page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'livreur') {
    header("Location: Accueil.php");
    exit();
}

$toutesLesCommandes = getCommandes();
?>

<main class="livreur-dashboard" style="padding: 20px;">
    <h1>🚴 Espace Coursier — Mosaïque Yum</h1>
    <p>Géstion des livraisons.</p>

    <div class="livreur-colonnes" style="display: flex; gap: 20px; margin-top: 20px;">
        <section class="livreur-colonne" style="flex: 1; background: var(--card-bg); padding: 15px; border-radius: 8px; border-top: 5px solid var(--rouge-mosaique);">
    <h2>📦 Commandes à récupérer (Prêtes)</h2>
    <div id="liste-pretes"></div>
       </section>

        <section class="livreur-colonne" style="flex: 1; background: var(--card-bg); padding: 15px; border-radius: 8px; border-top: 5px solid #4CAF50;">
            <h2>🛵 Ma Tournée (En livraison)</h2>
            <div id="liste-en-livraison"></div>
        </section>

    </div>
</main>

<script src="livreur.js"></script>
