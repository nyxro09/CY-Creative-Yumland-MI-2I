<?php 
include('header.php'); 
require_once('fonctions.php');

// Sécurité : Si l'utilisateur n'est pas connecté, on le dégage vers la page de connexion
if (!isset($_SESSION['email'])) {
    header("Location: Login.php");
    exit();
}

// Récupération sécurisée des données de la session active
$nom = $_SESSION['nom'] ?? '';
$prenom = $_SESSION['prenom'] ?? '';
$email = $_SESSION['email'] ?? '';
$adresse = $_SESSION['adresse'] ?? 'Aucune adresse enregistrée';
$pointsFidelite = $_SESSION['points_fidelite'] ?? 0;

$nomCompletClient = $prenom . ' ' . $nom;

// Récupération et filtrage de l'historique des commandes de ce client
$toutesLesCommandes = getCommandes();
$commandesClient = [];

if (is_array($toutesLesCommandes)) {
    foreach ($toutesLesCommandes as $commande) {
        // On ne garde que les commandes qui appartiennent au client connecté
        if (isset($commande['client']) && $commande['client'] === $nomCompletClient) {
            $commandesClient[] = $commande;
        }
    }
}
?>

    <main class="profil-main">
        <div class="profil-container">
            
            <section class="profil-infos">
    <h2>Mes Informations</h2>
    
    <div class="fidelite-carte">
    <p>Statut : <span class="promo-text">Client Or</span></p>
    <p>Vous avez cumulé <span class="promo-text"><?php echo $pointsFidelite; ?> points</span> de fidélité !</p>
</div>

    <div class="info-groupe">
        <label>Email (Identifiant) :</label>
        <p><?php echo htmlspecialchars($email); ?></p>
    </div>

    <div class="info-groupe">
        <label>Nom :</label>
        <p id="valeur-nom"><?php echo htmlspecialchars($nom); ?></p>
        <button id="btn-nom" class="btn-edit" onclick="editerChamp('nom')" title="Modifier">✏️</button>
    </div>

    <div class="info-groupe">
        <label>Prénom :</label>
        <p id="valeur-prenom"><?php echo htmlspecialchars($prenom); ?></p>
        <button id="btn-prenom" class="btn-edit" onclick="editerChamp('prenom')" title="Modifier">✏️</button>
    </div>

    <div class="info-groupe">
        <label>Adresse de livraison :</label>
        <p id="valeur-adresse"><?php echo htmlspecialchars($adresse); ?></p>
        <button id="btn-adresse" class="btn-edit" onclick="editerChamp('adresse')" title="Modifier">✏️</button>
    </div>
</section>
            <section class="profil-historique">
                <h2>Mon historique de commandes</h2>
                <table class="table-commandes">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Commande</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th>Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($commandesClient)) : ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">Vous n'avez pas encore passé de commande.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($commandesClient as $commande) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($commande['date'] ?? 'N/A'); ?></td>
                                    <td>
                                        <?php 
                                        if (isset($commande['articles']) && is_array($commande['articles'])) {
                                            $detailsArticles = [];
                                            foreach ($commande['articles'] as $article) {
                                                $detailsArticles[] = ($article['quantite'] ?? 1) . 'x ' . ($article['nom'] ?? 'Produit');
                                            }
                                            echo htmlspecialchars(implode(', ', $detailsArticles));
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo number_format($commande['total'] ?? 0, 2, ',', ' '); ?>€</td>
                                    <td class="statut-<?php echo htmlspecialchars($commande['statut'] ?? 'en_attente'); ?>">
                                        <?php 
                                        // Traduction des statuts pour l'affichage client
                                        $lesStatuts = [
                                            'en_attente' => 'En attente',
                                            'preparation' => 'En préparation',
                                            'prete' => 'Prête',
                                            'livraison' => 'En livraison',
                                            'livre' => 'Livrée',
                                            'abandonne' => 'Annulée'
                                        ];
                                        echo htmlspecialchars($lesStatuts[$commande['statut'] ?? 'en_attente'] ?? $commande['statut']);
                                        ?>
                                    </td>
                                    <td>
                                        <?php if (($commande['statut'] ?? '') === 'livre') : ?>
                                            <a href="Notation.php?id=<?php echo urlencode($commande['id']); ?>" class="btn-order btn-small" style="display: inline-block;">Noter</a>
                                        <?php else : ?>
                                            <em>Suivi en cours</em>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

        </div>
    </main>

<script src="profil.js"></script>

<?php include('footer.php'); ?>