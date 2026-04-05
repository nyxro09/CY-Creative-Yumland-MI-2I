<?php include('header.php'); ?>

<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'livree') {
            modifierStatutCommande($_POST['id_commande'], 'livree');
        }  
        if ($_POST['action'] === 'probleme') {
            modifierStatutCommande($_POST['id_commande'], 'probleme');
        }
        header('Location: Livreur.php');
        exit();
    }
?>

<?php
$commandes = getCommandes(); 
$commandesLivraison = array_filter($commandes, fn($c) => $c['statut'] === 'en_livraison');
$commande = reset($commandesLivraison);  

$utilisateurs = getUtilisateurs();
$adresseClient = 'Adresse non disponible';
foreach ($utilisateurs as $user) {
    if ($user['prenom'] . ' ' . $user['nom'] === $commande['client']) {
        $adresseClient = $user['adresse'] ?? 'Adresse non disponible';
        break;
    }
}
?>

<main> 
    <section id="page-livreur">

        <?php if (!$commande) : ?>
            <h2>Aucune course en cours</h2>
            <p style="text-align:center;">Pas de commande en livraison pour le moment.</p>

        <?php else : ?>

            <h2>Course en cours #<?php echo substr($commande['id'], -6); ?></h2>

            <div class="boite-client">  
                <h3>Infos Client</h3>
                <p>👤 <?php echo $commande['client']; ?></p>
                <hr>
                <p>📍 <?php echo $adresseClient; ?></p>
            </div>

            <div class="boite-commande">
                <h3>Détail Commande</h3>
                <?php foreach ($commande['articles'] as $article) : ?>
                    <p><?php echo $article['quantite']; ?>x <?php echo $article['nom']; ?></p>
                <?php endforeach; ?>
                <p><strong>Total payé : <?php echo number_format($commande['total'], 2, ',', ' '); ?>€ (Déjà réglé)</strong></p>
            </div>

            <form action="Livreur.php" method="POST">
                <input type="hidden" name="action" value="livree">
                <input type="hidden" name="id_commande" value="<?php echo $commande['id']; ?>">
                <button type="submit" class="gros-bouton vert">✅ LIVRAISON TERMINÉE</button>
            </form>

            <form action="Livreur.php" method="POST">
                <input type="hidden" name="action" value="probleme">
                <input type="hidden" name="id_commande" value="<?php echo $commande['id']; ?>">
                <button type="submit" class="gros-bouton rouge"> ❌ PROBLÈME</button>
            </form>

        <?php endif; ?>

    </section> 
 </main>

<?php include('footer.php'); ?>
