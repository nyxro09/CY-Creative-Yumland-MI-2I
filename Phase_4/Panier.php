<?php include('header.php'); ?>

<?php
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'];
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prix = floatval($_POST['prix']); 

    if ($action === 'ajouter') {
        if (isset($_SESSION['panier'][$id])) {
            $_SESSION['panier'][$id]['quantite']++;
        } else {
            $_SESSION['panier'][$id] = [
                'id'       => $id,
                'nom'      => $nom,
                'prix'     => $prix,
                'quantite' => 1,
            ];
        }
    }

    if ($action === 'augmenter') {
        $id = $_POST['id'];
        $_SESSION['panier'][$id]['quantite']++;
    }

    if ($action === 'diminuer') {
        $id = $_POST['id'];
        $_SESSION['panier'][$id]['quantite']--;
        if ($_SESSION['panier'][$id]['quantite'] <= 0) {
            unset($_SESSION['panier'][$id]);
        }
    }

    if ($action === 'supprimer') {
        $id = $_POST['id'];
        unset($_SESSION['panier'][$id]);
    }

    if ($action === 'ajouter') {
        header('Location: Carte.php?ajout=ok');
    } else {
        header('Location: Panier.php');
    }
    exit();
}
?>

<main>
    <section id="panier">
        <h1>🛒 Mon Panier</h1>
        <?php if (empty($_SESSION['panier'])) : ?>

    <p>Votre panier est vide.</p>
    <a href="Carte.php" class="btn-order">Voir la carte</a>

<?php else : ?>

    <table class="table-commandes">
        <thead>
            <tr>
                <th>Article</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['panier'] as $article) : ?>
            <tr>
                <td><?php echo $article['nom']; ?></td>
                <td><?php echo number_format($article['prix'], 2, ',', ' '); ?>€</td>
                <td>
                    <form action="Panier.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="diminuer">
                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                        <input type="hidden" name="nom" value="">
                        <input type="hidden" name="prix" value="0">
                        <button type="submit" class="btn-edit">−</button>
                    </form>

                    <strong><?php echo $article['quantite']; ?></strong>

                    <form action="Panier.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="augmenter">
                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                        <input type="hidden" name="nom" value="">
                        <input type="hidden" name="prix" value="0">
                        <button type="submit" class="btn-edit">+</button>
                    </form>
                </td>
                <td><?php echo number_format($article['prix'] * $article['quantite'], 2, ',', ' '); ?>€</td>
                <td>
                    <form action="Panier.php" method="POST" style="display:inline;">
                        <input type="hidden" name="action" value="supprimer">
                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                        <input type="hidden" name="nom" value="">
                        <input type="hidden" name="prix" value="0">
                        <button type="submit" class="btn-edit" style="color:red;">🗑️</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3"><strong>TOTAL</strong></td>
                <td>
                    <strong>
                    <?php
                    $total = 0;
                    foreach ($_SESSION['panier'] as $article) {
                        $total += $article['prix'] * $article['quantite'];
                    }
                    echo number_format($total, 2, ',', ' ');
                    ?>€
                        </strong>
                </td>
                <td></td>
            </tr>
</tfoot>

    </table>

    <div style="text-align:right; margin-top:20px;">
        <a href="Paiement.php" class="gros-bouton vert" style="display:inline-block; text-align:center; text-decoration:none;">
            ✅ Passer au paiement
        </a>
    </div>

<?php endif; ?>
    </section>
</main>

<?php include('footer.php'); ?>
