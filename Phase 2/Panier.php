<?php include('header.php'); ?>

<?php
// Si le panier n'existe pas encore, on le crée vide
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
?>

<main>
    <section id="panier">
        <h1>🛒 Mon Panier</h1>
        <p>Le panier fonctionne !</p>
    </section>
</main>

<?php include('footer.php'); ?>