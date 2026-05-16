async function editerChamp(champ) {
    // On cible le paragraphe et le bouton concernés
    const p = document.getElementById(`valeur-${champ}`);
    const btn = document.getElementById(`btn-${champ}`);

    // Si on est en mode "Lecture" (Le bouton est un crayon)
    if (btn.innerText === '✏️') {
        const valeurActuelle = p.innerText;
        // On remplace le texte par une zone de saisie
        p.innerHTML = `<input type="text" id="input-${champ}" value="${valeurActuelle}" style="padding:5px; width:80%;">`;
        btn.innerText = '💾';
        btn.title = "Sauvegarder";
    } 
    // Si on est en mode "Sauvegarde" 
    else {
    
        const input = document.getElementById(`input-${champ}`);
        const nouvelleValeur = input.value;

        try {
            // On lance la requête POST Asynchrone
            const reponse = await fetch('api_update_profil.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                
                body: JSON.stringify({
                    champ: champ,
                    valeur: nouvelleValeur
                })
            });

            // On lit la réponse du serveur
            const data = await reponse.json();

            if (data.success) {
                // Si le serveur a bien enregistré, on valide l'affichage
                p.innerText = data.valeur;
                btn.innerText = '✏️'; 
                btn.title = "Modifier";
                
            
                btn.style.backgroundColor = '#4CAF50'; 
                setTimeout(() => { btn.style.backgroundColor = ''; }, 1500);

            } else {
                // Si le serveur a refusé 
                alert("Erreur : " + data.message);
                p.innerText = nouvelleValeur; 
            }

        } catch (erreur) {
            console.error("Erreur de communication :", erreur);
            alert("Impossible de joindre le serveur. Vérifiez votre connexion.");
        }
    }
}