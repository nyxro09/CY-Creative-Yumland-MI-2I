<?php 
include('header.php'); 
require_once('fonctions.php');

// On s'assure que seul le restaurateur accède à cette page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'restaurateur') {
    header("Location: Accueil.php");
    exit();
}

$toutesLesCommandes = getCommandes();
?>

<main class="resto-dashboard" style="padding: 20px;">
    <h1>🍳 Console Cuisine - Mosaïque Yum</h1>
    <p>Géstion des commandes en temps réel.</p>

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

<script src="restaurateur.js"></script>

<?php include('footer.php'); ?><?php 
include('header.php'); 
require_once('fonctions.php');

// On s'assure que seul le restaurateur accède à cette page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'restaurateur') {
    header("Location: Accueil.php");
    exit();
}

$toutesLesCommandes = getCommandes();
?>

<main class="resto-dashboard" style="padding: 20px;">
    <h1>🍳 Console Cuisine - Mosaïque Yum</h1>
    <p>Géstion des commandes en temps réel.</p>

    <div class="resto-colonnes" style="display: flex; gap: 20px; margin-top: 20px;">
        
        <section class="resto-colonne" style="flex: 1; background: var(--card-bg); padding: 15px; border-radius: 8px; border-top: 5px solid var(--jaune-action);">
            <h2>📥 À Préparer (En attente)</h2>
            <div id="liste-en-attente">
                <?php foreach ($toutesLesCommandes as $commande) : ?>
                    <?php if ($commande['statut'] === 'en_attente') : ?>
                        <div class="commande-card" id="card-<?php echo $commande['id']; ?>" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <h3>Commande #<?php echo $commande['id']; ?></h3>
                            <p><strong>Client :</strong> <?php echo htmlspecialchars($commande['client']); ?></p>
                            <ul>
                                <?php foreach ($commande['articles'] as $art) : ?>
                                    <li><?php echo $art['quantite']; ?>x <?php echo htmlspecialchars($art['nom']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button class="btn-order" onclick="changerStatut('<?php echo $commande['id']; ?>', 'preparation')" style="background-color: #ff9800; width: 100%;">👨‍🍳 Lancer la préparation</button>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="resto-colonne" style="flex: 1; background: var(--card-bg); padding: 15px; border-radius: 8px; border-top: 5px solid #4CAF50;">
            <h2>🔥 En Cuisine (En préparation)</h2>
            <div id="liste-en-preparation">
                <?php foreach ($toutesLesCommandes as $commande) : ?>
                    <?php if ($commande['statut'] === 'preparation') : ?>
                        <div class="commande-card" id="card-<?php echo $commande['id']; ?>" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <h3>Commande #<?php echo $commande['id']; ?></h3>
                            <p><strong>Client :</strong> <?php echo htmlspecialchars($commande['client']); ?></p>
                            <ul>
                                <?php foreach ($commande['articles'] as $art) : ?>
                                    <li><?php echo $art['quantite']; ?>x <?php echo htmlspecialchars($art['nom']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button class="btn-order" onclick="changerStatut('<?php echo $commande['id']; ?>', 'prete')" style="background-color: #4CAF50; width: 100%;">📦 Commande Prête !</button>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

    </div>
</main>

<script src="restaurateur.js"></script>

<?php include('footer.php'); ?>
