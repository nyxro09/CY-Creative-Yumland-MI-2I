
// 1. LE POLLING (RÉCEPTION DES COMMANDES CLIENT EN TEMPS RÉEL)

async function actualiserConsoleCuisine() {
    try {
        // On récupère le fichier commandes.json via l'API
        const reponse = await fetch('api_get_commandes.php');
        if (!reponse.ok) throw new Error("Erreur lors de la récupération des commandes");
        
        const commandes = await reponse.json();
        
        const conteneurAttente = document.getElementById('liste-en-attente');
        const conteneurPreparation = document.getElementById('liste-en-preparation');
        
        // On vide pour éviter les doublons
        conteneurAttente.innerHTML = '';
        conteneurPreparation.innerHTML = '';

        commandes.forEach(cmd => {
            // Reconstitution de la liste des articles de la commande
            let articlesHtml = '<ul>';
            cmd.articles.forEach(art => {
                articlesHtml += `<li>${art.quantite}x ${art.nom}</li>`;
            });
            articlesHtml += '</ul>';

            if (cmd.statut === 'en_attente') {
                conteneurAttente.innerHTML += `
                    <div class="commande-card" id="card-${cmd.id}" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); color: #333;">
                        <h3>Commande #${cmd.id}</h3>
                        <p><strong>Client :</strong> ${cmd.client}</p>
                        ${articlesHtml}
                        <button class="btn-order" onclick="changerStatutResto('${cmd.id}', 'preparation')" style="background-color: #ff9800; width: 100%; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer;">👨‍🍳 Lancer la préparation</button>
                    </div>
                `;
            } 
            else if (cmd.statut === 'preparation') {
                conteneurPreparation.innerHTML += `
                    <div class="commande-card" id="card-${cmd.id}" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); color: #333;">
                        <h3>Commande #${cmd.id}</h3>
                        <p><strong>Client :</strong> ${cmd.client}</p>
                        ${articlesHtml}
                        <button class="btn-order" onclick="changerStatutResto('${cmd.id}', 'prete')" style="background-color: #4CAF50; width: 100%; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer;">📦 Commande Prête !</button>
                    </div>
                `;
            }
        });
    } catch (erreur) {
        console.error("Erreur de synchronisation Cuisine :", erreur);
    }
}

// Rafraîchissement automatique toutes les 5 secondes
setInterval(actualiserConsoleCuisine, 5000);
document.addEventListener('DOMContentLoaded', actualiserConsoleCuisine);

// 2. L'ENVOI DES CHANGEMENTS DE STATUT (VERS LE SERVEUR)

async function changerStatutResto(idCommande, nouveauStatut) {
    const carte = document.getElementById(`card-${idCommande}`);
    if (carte) {
        const bouton = carte.querySelector('button');
        if (bouton) bouton.disabled = true;
    }

    try {
        const reponse = await fetch('api_update_commande.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idCommande, statut: nouveauStatut })
        });

        const data = await reponse.json();

        if (data.success) {
            // Mise à jour instantanée de l'affichage
            actualiserConsoleCuisine();
        } else {
            alert("Erreur : " + data.message);
        }
    } catch (erreur) {
        console.error("Erreur réseau :", erreur);
    }
}
