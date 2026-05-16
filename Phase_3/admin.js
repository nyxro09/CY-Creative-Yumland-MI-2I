async function toggleAcces(idCible) {
    // On cible le bouton et la cellule de texte correspondant à cet ID
    const btn = document.getElementById(`btn-${idCible}`);
    const celluleStatut = document.getElementById(`statut-${idCible}`);

    
    const texteOriginal = btn.innerText;
    btn.innerText = "⏳ En cours...";
    btn.disabled = true;

    try {
        // On envoie la requête POST à notre API
        const reponse = await fetch('api_toggle_block.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idCible })
        });

        const data = await reponse.json();

        if (data.success) {
            // L'API a réussi. On met à jour l'interface en fonction du nouveau statut
            if (data.est_bloque) {
                celluleStatut.innerText = "Banni 🚫";
                btn.innerText = "Débloquer";
                btn.style.backgroundColor = "#4CAF50"; // Devient vert (pour débloquer)
            } else {
                celluleStatut.innerText = "Actif ✅";
                btn.innerText = "Bloquer";
                btn.style.backgroundColor = "#f44336"; // Devient rouge (pour bloquer)
            }
        } else {
            // L'API a renvoyé une erreur (ex: droits insuffisants)
            alert("Échec : " + data.message);
            btn.innerText = texteOriginal; // On remet comme avant
        }
    } catch (erreur) {
        console.error("Erreur réseau :", erreur);
        alert("Impossible de joindre le serveur.");
        btn.innerText = texteOriginal;
    } finally {
        // Dans tous les cas, on réactive le bouton à la fin
        btn.disabled = false;
    }
}