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
    <div id="liste-pretes">
        <?php foreach ($toutesLesCommandes as $commande) : ?>
            <?php if ($commande['statut'] === 'prete') : ?>
                <div class="commande-card" id="card-<?php echo $commande['id']; ?>" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <h3>Commande #<?php echo $commande['id']; ?></h3>
                    <p><strong>Client :</strong> <?php echo htmlspecialchars($commande['client']); ?></p>
                    
                    <p><strong>Adresse :</strong> 📍 <em><?php echo htmlspecialchars($commande['adresse'] ?? 'Adresse non renseignée'); ?></em></p>
                    
                    <button class="btn-order" onclick="changerStatutLivreur('<?php echo $commande['id']; ?>', 'livraison')" style="background-color: #2196F3; width: 100%;">🚀 Prendre la commande</button>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
       </section>

        <section class="livreur-colonne" style="flex: 1; background: var(--card-bg); padding: 15px; border-radius: 8px; border-top: 5px solid #4CAF50;">
            <h2>🛵 Ma Tournée (En livraison)</h2>
            <div id="liste-en-livraison">
                <?php foreach ($toutesLesCommandes as $commande) : ?>
                    <?php if ($commande['statut'] === 'livraison') : ?>
                        <div class="commande-card" id="card-<?php echo $commande['id']; ?>" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <h3>Commande #<?php echo $commande['id']; ?></h3>
                            <p><strong>Client :</strong> <?php echo htmlspecialchars($commande['client']); ?></p>
                            <p><strong>Adresse :</strong> 📍 <em><?php echo htmlspecialchars($commande['adresse'] ?? 'Non spécifiée'); ?></em></p>
                            <button class="btn-order" onclick="changerStatutLivreur('<?php echo $commande['id']; ?>', 'livre')" style="background-color: #4CAF50; width: 100%;">✅ Valider la livraison</button>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </section>

    </div>
</main>

<script src="livreur.js"></script>

<?php include('footer.php'); ?>
