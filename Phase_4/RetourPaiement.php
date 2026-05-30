<?php
include('header.php');
require('getapikey.php');

$transaction = $_GET['transaction'] ?? '';
$montant = $_GET['montant'] ?? '';
$vendeur = $_GET['vendeur'] ?? '';
$statut = $_GET['status'] ?? '';
$control = $_GET['control'] ?? '';

$api_key = getAPIKey($vendeur);
$control_valide = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $statut . "#");

$paiement_ok = ($control === $control_valide) && ($statut === 'accepted');
?>

<main>
    <section id="retour-paiement">

        <?php if ($paiement_ok) : ?>

            <h1>✅ Paiement accepté !</h1>
            <p>Merci pour votre commande. Elle est en cours de préparation.</p>
            <p>Montant débité : <strong><?php echo number_format($montant, 2, ',', ' '); ?>€</strong></p>

            <?php
            $nouvelleCommande = [
                'id' => $transaction,
                // Sécurise la récupération du nom
                'client' => ($_SESSION['prenom'] ?? 'Client') . ' ' . ($_SESSION['nom'] ?? 'Inconnu'),
                'articles' => array_values($_SESSION['panier']),
                'total' => floatval($montant),
                'statut' => 'en_attente',
                'date' => date('d/m/Y H:i')
            ];

            ajouterCommande($nouvelleCommande);

            $_SESSION['panier'] = [];
            ?>
            <a href="Accueil.php" class="btn-order" style="display:inline-block; margin-top:15px;">
                Retour à l'accueil
            </a>

        <?php else : ?>

            <h1>❌ Paiement refusé</h1>
            <p>Votre paiement n'a pas pu être validé.</p>

            <a href="Panier.php" class="btn-order" style="display:inline-block; margin-top:15px;">
                Retour au panier
            </a>

        <?php endif; ?>

    </section>
</main>

<?php include('footer.php'); ?>
