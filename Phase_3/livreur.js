async function changerStatutLivreur(idCommande, nouveauStatut) {
    const carte = document.getElementById(`card-${idCommande}`);
    const bouton = carte.querySelector('button');
    
    bouton.disabled = true;

    try {
        const reponse = await fetch('api_update_commande.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idCommande, statut: nouveauStatut })
        });

        const data = await reponse.json();

        if (data.success) {
            if (nouveauStatut === 'livraison') {
                // On déplace la carte dans la colonne "Ma Tournée"
                const colonneLivraison = document.getElementById('liste-en-livraison');
                colonneLivraison.appendChild(carte);
                
                // On prépare le bouton pour la validation finale
                bouton.innerText = "✅ Valider la livraison";
                bouton.style.backgroundColor = "#4CAF50";
                bouton.setAttribute('onclick', `changerStatutLivreur('${idCommande}', 'livre')`);
                bouton.disabled = false;
            } 
            else if (nouveauStatut === 'livre') {
                // C'est livré ! On fait disparaître la carte proprement
                carte.style.transition = "all 0.5s ease";
                carte.style.opacity = "0";
                setTimeout(() => {
                    carte.remove();
                }, 500);
            }
        } else {
            alert("Erreur : " + data.message);
            bouton.disabled = false;
        }

    } catch (erreur) {
        console.error("Erreur réseau :", erreur);
        alert("Impossible de joindre le serveur de livraison.");
        bouton.disabled = false;
    }
}