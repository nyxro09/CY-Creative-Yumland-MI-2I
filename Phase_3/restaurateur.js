async function changerStatut(idCommande, nouveauStatut) {
    const carte = document.getElementById(`card-${idCommande}`);
    const bouton = carte.querySelector('button');
    
    // Désactivation temporaire du bouton pendant l'envoi
    bouton.disabled = true;

    try {
        const reponse = await fetch('api_update_commande.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idCommande, statut: nouveauStatut })
        });

        const data = await reponse.json();

        if (data.success) {
            if (nouveauStatut === 'preparation') {
                // Étape 1 : On déplace la carte dans la colonne "En préparation"
                const colonnePreparation = document.getElementById('liste-en-preparation');
                colonnePreparation.appendChild(carte);
                
                // Étape 2 : On transforme le bouton pour l'étape suivante
                bouton.innerText = "📦 Commande Prête !";
                bouton.style.backgroundColor = "#4CAF50";
                // On met à jour l'événement onclick pour le prochain clic
                bouton.setAttribute('onclick', `changerStatut('${idCommande}', 'prete')`);
                bouton.disabled = false;
            } 
            else if (nouveauStatut === 'prete') {
                // Si la commande est prête, elle quitte la cuisine pour aller chez le livreur
                carte.style.transition = "all 0.5s ease";
                carte.style.opacity = "0";
                setTimeout(() => {
                    carte.remove(); // On la supprime de l'écran du restaurateur
                }, 500);
            }
        } else {
            alert("Erreur : " + data.message);
            bouton.disabled = false;
        }

    } catch (erreur) {
        console.error("Erreur réseau :", erreur);
        alert("Impossible de joindre le serveur de cuisine.");
        bouton.disabled = false;
    }
}