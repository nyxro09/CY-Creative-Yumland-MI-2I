<?php
include('header.php');
require('getapikey.php');

$vendeur = 'MI-2_I';
$api_key = getAPIKey($vendeur);

$total = 0;
foreach ($_SESSION['panier'] as $article) {
    $total += $article['prix'] * $article['quantite'];
}
$montant = number_format($total, 2, '.', ''); 

$transaction = 'MOSAIQUEYUM' . strtoupper(uniqid());

$retour = 'http://localhost/Phase2/RetourPaiement.php';

$control = md5($api_key . "#" . $transaction . "#" . $montant . "#" . $vendeur . "#" . $retour . "#");
?>
<main>
    <section id="paiement">
        <h1>💳 Validation de la commande</h1>
        <h2>Récapitulatif</h2>
        <table class="table-commandes">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Quantité</th>
                    <th>Sous-total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['panier'] as $article) : ?>
                <tr>
                    <td><?php echo $article['nom']; ?></td>
                    <td><?php echo $article['quantite']; ?></td>
                    <td><?php echo number_format($article['prix'] * $article['quantite'], 2, ',', ' '); ?>€</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><strong>TOTAL</strong></td>
                    <td><strong><?php echo number_format($total, 2, ',', ' '); ?>€</strong></td>
                </tr>
            </tfoot>
        </table>

        <form action='https://www.plateforme-smc.fr/cybank/index.php' method='POST'>
            <input type='hidden' name='transaction' value='<?php echo $transaction; ?>'>
            <input type='hidden' name='montant' value='<?php echo $montant; ?>'>
            <input type='hidden' name='vendeur' value='<?php echo $vendeur; ?>'>
            <input type='hidden' name='retour' value='<?php echo $retour; ?>'>
            <input type='hidden' name='control' value='<?php echo $control; ?>'>
            <button type='submit' class='gros-bouton vert'>✅ Payer <?php echo number_format($total, 2, ',', ' '); ?>€</button>
        </form>

        <a href="Panier.php" style="display:block; text-align:center; margin-top:15px;">← Retour au panier</a>
    </section>
</main>
<?php include('footer.php'); ?>
