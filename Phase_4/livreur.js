// 1. LE MOTEUR DE RECHERCHE (POLLING)
async function actualiserCommandesLivreur() {
    try {
        const reponse = await fetch('api_get_commandes.php');
        if (!reponse.ok) throw new Error("Erreur réseau HTTP : " + reponse.status);
        
        // Si ton fichier JSON a été corrompu par une erreur PHP précédente, ça plantera ici
        const texteBrut = await reponse.text();
        const commandes = JSON.parse(texteBrut);
        
        const conteneurPretes = document.getElementById('liste-pretes');
        const conteneurLivraison = document.getElementById('liste-en-livraison');
        
        conteneurPretes.innerHTML = '';
        conteneurLivraison.innerHTML = '';

        commandes.forEach(cmd => {
            if (cmd.statut === 'prete') {
                conteneurPretes.innerHTML += `
                    <div class="commande-card" id="card-${cmd.id}" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <h3>Commande #${cmd.id}</h3>
                        <p><strong>Client :</strong> ${cmd.client}</p>
                        <p><strong>Adresse :</strong> 📍 <em>${cmd.adresse || 'Adresse non renseignée'}</em></p>
                        <button class="btn-order" onclick="changerStatutLivreur('${cmd.id}', 'livraison')" style="background-color: #2196F3; width: 100%;">🚀 Prendre la commande</button>
                    </div>
                `;
            } 
            else if (cmd.statut === 'livraison') {
                conteneurLivraison.innerHTML += `
                    <div class="commande-card" id="card-${cmd.id}" style="background: white; padding: 15px; margin-bottom: 10px; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <h3>Commande #${cmd.id}</h3>
                        <p><strong>Client :</strong> ${cmd.client}</p>
                        <p><strong>Adresse :</strong> 📍 <em>${cmd.adresse || 'Non spécifiée'}</em></p>
                        <button class="btn-order" onclick="changerStatutLivreur('${cmd.id}', 'livre')" style="background-color: #4CAF50; width: 100%;">✅ Valider la livraison</button>
                    </div>
                `;
            }
        });
    } catch (erreur) {
        console.error("Le Polling a planté (le JSON est peut-être corrompu) :", erreur);
    }
}

setInterval(actualiserCommandesLivreur, 5000);
document.addEventListener('DOMContentLoaded', actualiserCommandesLivreur);

// 2. L'ENVOI DES ACTIONS AU SERVEUR AVEC DÉBOGAGE ULTRA AGRESSIF
async function changerStatutLivreur(idCommande, nouveauStatut) {
    const carte = document.getElementById(`card-${idCommande}`);
    let bouton = null;
    if(carte) {
        bouton = carte.querySelector('button');
        if(bouton) bouton.disabled = true; // On bloque le bouton
    }

    try {
        const reponse = await fetch('api_update_commande.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idCommande, statut: nouveauStatut })
        });

        // ASTUCE DE PRO : On lit la réponse en texte brut avant de la forcer en JSON
        const texteBrut = await reponse.text();
        
        let data;
        try {
            data = JSON.parse(texteBrut); // On essaie de la convertir
        } catch (e) {
            // SI ÇA PLANTE ICI, C'EST QUE TON PHP A CRASHÉ !
            throw new Error("Ton serveur PHP a planté et a renvoyé ça au lieu d'un JSON :\n\n" + texteBrut);
        }

        if (data.success) {
            actualiserCommandesLivreur(); // Tout est OK, on rafraîchit l'interface
        } else {
            alert("Le PHP a dit non : " + data.message);
            if(bouton) bouton.disabled = false; // On débloque le bouton pour réessayer
        }

    } catch (erreur) {
        console.error("CRASH SERVEUR :", erreur);
        // On affiche l'erreur en plein écran pour que tu voies ton bug PHP
        alert(erreur.message); 
        if(bouton) bouton.disabled = false; // On débloque le bouton
    }
}
