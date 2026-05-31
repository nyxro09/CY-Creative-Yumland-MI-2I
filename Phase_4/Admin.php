<?php 
include('header.php'); 
require_once('fonctions.php');

// On dégage immédiatement ceux qui ne sont pas admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: Accueil.php");
    exit();
}

// On récupère tous les utilisateurs pour les afficher
$tousLesUtilisateurs = getUtilisateurs();
?>

<main class="admin-dashboard">
    <div class="admin-container" style="padding: 20px;">
        <h1>🛡️ Panneau de Contrôle Administrateur</h1>
        <p>Gestion des accès et modération des utilisateurs.</p>

        <table class="table-commandes" style="width: 100%; margin-top: 20px;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom / Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tousLesUtilisateurs as $user) : ?>
                    <?php if ($user['id'] === $_SESSION['user_id']) continue; ?>
                    
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td><?php echo htmlspecialchars($user['nom'] . ' ' . $user['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td>
                            <select onchange="changerRole('<?php echo $user['id']; ?>', this)" style="padding: 5px; border-radius: 4px; font-weight: bold; cursor: pointer;">
                              <option value="client" <?php echo $user['role'] === 'client' ? 'selected' : ''; ?>>CLIENT</option>
                              <option value="restaurateur" <?php echo $user['role'] === 'restaurateur' ? 'selected' : ''; ?>>RESTAURATEUR</option>
                              <option value="livreur" <?php echo $user['role'] === 'livreur' ? 'selected' : ''; ?>>LIVREUR</option>
                              <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>ADMIN</option>
                            </select>
                        </td>
                        
                        <?php 
                            // Détermination du statut actuel
                            $estBloque = isset($user['est_bloque']) && $user['est_bloque'] === true;
                            $texteStatut = $estBloque ? "Banni 🚫" : "Actif ✅";
                            $texteBouton = $estBloque ? "Débloquer" : "Bloquer";
                            $couleurBouton = $estBloque ? "background-color: #4CAF50;" : "background-color: #f44336;";
                        ?>
                        
                        <td id="statut-<?php echo $user['id']; ?>"><?php echo $texteStatut; ?></td>
                        <td>
                            <button 
                                id="btn-<?php echo $user['id']; ?>" 
                                class="btn-order" 
                                style="<?php echo $couleurBouton; ?>"
                                onclick="toggleAcces('<?php echo $user['id']; ?>')">
                                <?php echo $texteBouton; ?>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include('footer.php'); ?>
