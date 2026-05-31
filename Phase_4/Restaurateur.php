<?php 
include('header.php'); 
require_once('fonctions.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'restaurateur') {
    header("Location: Accueil.php");
    exit();
}
?>

<main class="resto-dashboard" style="padding: 20px;">
    <h1>🍳 Console Cuisine - Mosaïque Yum</h1>
    <p>Gestion des commandes en temps réel.</p>
    <div class="resto-colonnes" style="display: flex; gap: 20px; margin-top: 20px;">
        <section class="resto-colonne" style="flex: 1; background: var(--card-bg); padding: 15px; border-radius: 8px; border-top: 5px solid var(--jaune-action);">
            <h2>📥 À Préparer (En attente)</h2>
            <div id="liste-en-attente"></div>
        </section>

        <section class="resto-colonne" style="flex: 1; background: var(--card-bg); padding: 15px; border-radius: 8px; border-top: 5px solid #4CAF50;">
            <h2>🔥 En Cuisine (En préparation)</h2>
            <div id="liste-en-preparation"></div>
        </section>
    </div>
</main>

<?php include('footer.php'); ?>
