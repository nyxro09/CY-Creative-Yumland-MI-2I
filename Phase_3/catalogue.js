let platsActuels = [];
let menusActuels = []; 
let categorieActuelle = ''; 

async function chargerPlats(categorie = '') {
    try {
        const reponse = await fetch('api_get_plats.php');
        if (!reponse.ok) throw new Error(`Erreur HTTP: ${reponse.status}`);

        const data = await reponse.json();
        
        platsActuels = data.plats || [];
        menusActuels = data.menus || [];
        categorieActuelle = categorie;

        if (categorie === 'Menu') {
            afficherMenus(menusActuels);
        } else {
            let platsFiltres = categorie ? platsActuels.filter(p => p.categorie === categorie) : platsActuels;
            afficherPlats(platsFiltres, categorie);
        }

    } catch (erreur) {
        console.error("Problème lors de la récupération :", erreur);
    }
}

function afficherPlats(plats, categorie) {
    const conteneur = document.getElementById('grille-dynamique');
    document.getElementById('titre-categorie').innerText = categorie === '' ? 'Toute notre carte' : 'Nos ' + categorie + 's';
    conteneur.innerHTML = ''; 

    if (plats.length === 0) {
        conteneur.innerHTML = '<p>Aucun plat trouvé.</p>';
        return;
    }

    plats.forEach(plat => {
        let badgeHtml = plat.badge ? `<div class="badge">${plat.badge}</div>` : '';
        let prixFormate = parseFloat(plat.prix).toFixed(2).replace('.', ',');
        const nomSecurise = plat.nom.replace(/'/g, "\\'");

        conteneur.innerHTML += `
            <article class="card">
                ${badgeHtml}
                <img src="${plat.image}" alt="${plat.nom}" onerror="this.src='images/default.jpg'">
                <div class="card-content">
                    <h3>${plat.nom}</h3>
                    <p>${plat.description}</p>
                    <div class="card-footer">
                        <span class="price">${prixFormate} €</span>
                        <button class="btn-order" onclick="ajouterAuPanier('${plat.id}', '${nomSecurise}', ${plat.prix}, this)">AJOUTER</button>
                    </div>
                </div>
            </article>
        `;
    });
}

function afficherMenus(menus) {
    const conteneur = document.getElementById('grille-dynamique');
    document.getElementById('titre-categorie').innerText = '🍱 Composez votre Menu';
    conteneur.innerHTML = ''; 

    menus.forEach(menu => {
        let prixFormate = parseFloat(menu.prix).toFixed(2).replace('.', ',');
        conteneur.innerHTML += `
            <article class="card" style="border: 2px solid var(--jaune-action);">
                <div class="card-content" style="text-align: center; padding-top: 30px;">
                    <h3 style="font-size: 1.5em;">${menu.nom}</h3>
                    <p style="font-weight: bold; color: var(--texte-principal);">${menu.description}</p>
                    <span class="price" style="display: block; margin: 15px 0; font-size: 1.8em;">${prixFormate} €</span>
                    <button class="gros-bouton vert" onclick="ouvrirModalMenu('${menu.id}')">COMPOSER CE MENU</button>
                </div>
            </article>
        `;
    });
}

function ouvrirModalMenu(idMenu) {
    const menu = menusActuels.find(m => m.id === idMenu);
    if (!menu) return;

    document.getElementById('modal-titre').innerText = menu.nom;
    document.getElementById('modal-desc').innerText = menu.description;
    
    const conteneurChoix = document.getElementById('modal-choix');
    conteneurChoix.innerHTML = ''; 

    const genererSelect = (categorie, label) => {
        const options = platsActuels.filter(p => p.categorie === categorie);
        let html = `<label>${label} :</label><select class="select-menu" required><option value="">-- Choisir --</option>`;
        options.forEach(opt => {
            html += `<option value="${opt.nom}">${opt.nom}</option>`;
        });
        html += `</select>`;
        return html;
    };

    if (idMenu === 'M001') {
        conteneurChoix.innerHTML += genererSelect('Pizza', '🍕 Votre Pizza');
        conteneurChoix.innerHTML += genererSelect('Boisson', '🥤 Votre Boisson');
    } else if (idMenu === 'M002') { 
        conteneurChoix.innerHTML += genererSelect('Pizza', '🍕 Votre Pizza');
        conteneurChoix.innerHTML += genererSelect('Salade', '🥗 Votre Salade');
        conteneurChoix.innerHTML += genererSelect('Dessert', '🍰 Votre Dessert');
        conteneurChoix.innerHTML += genererSelect('Boisson', '🥤 Votre Boisson');
    } else if (idMenu === 'M003') { 
        conteneurChoix.innerHTML += genererSelect('Pizza', '🍕 Votre Pizza');
        conteneurChoix.innerHTML += genererSelect('Dessert', '🍰 Votre Dessert');
        conteneurChoix.innerHTML += genererSelect('Boisson', '🥤 Votre Boisson');
    }

    const btnValider = document.getElementById('btn-valider-menu');
    btnValider.onclick = () => validerCompositionMenu(menu);

    document.getElementById('modal-menu').style.display = 'flex';
}

function fermerModal() {
    document.getElementById('modal-menu').style.display = 'none';
}

async function validerCompositionMenu(menu) {
    const selects = document.querySelectorAll('#modal-choix select');
    let composition = [];
    
    for (let select of selects) {
        if (select.value === "") {
            alert("Veuillez remplir tous les choix de votre menu !");
            return;
        }
        composition.push(select.value);
    }

    const nomCombine = `${menu.nom} (${composition.join(', ')})`;
    const btn = document.getElementById('btn-valider-menu');
    btn.disabled = true;
    btn.innerText = "Ajout en cours...";

    try {
        const reponse = await fetch('api_add_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: menu.id, nom: nomCombine, prix: menu.prix })
        });

        const data = await reponse.json();

        if (data.success) {
            fermerModal();
            creerToastNotification(`🍱 ${menu.nom} ajouté au panier !`);
        } else {
            alert("Erreur : " + data.message);
        }
    } catch (erreur) {
        console.error("Erreur", erreur);
    } finally {
        btn.disabled = false;
        btn.innerText = "🛒 Ajouter ce menu au panier";
    }
}

function trierPlats(ordre) {
    if (platsActuels.length === 0) return;
    let platsTries = [...platsActuels];
    if (ordre === 'croissant') platsTries.sort((a, b) => parseFloat(a.prix) - parseFloat(b.prix));
    else if (ordre === 'decroissant') platsTries.sort((a, b) => parseFloat(b.prix) - parseFloat(a.prix));
    afficherPlats(platsTries, categorieActuelle);
}

async function ajouterAuPanier(idPlat, nomPlat, prixPlat, bouton) {
    bouton.disabled = true;
    try {
        const reponse = await fetch('api_add_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: idPlat, nom: nomPlat, prix: prixPlat })
        });
        const data = await reponse.json();
        if (data.success) {
            bouton.classList.add('btn-added');
            bouton.innerText = '✓ AJOUTÉ';
            creerToastNotification(`🛒 ${nomPlat} ajouté au panier !`);
            setTimeout(() => { bouton.classList.remove('btn-added'); bouton.innerText = 'AJOUTER'; bouton.disabled = false; }, 1200);
        }
    } catch (erreur) {
        console.error(erreur);
    }
}

function creerToastNotification(message) {
    const toast = document.createElement('div');
    toast.className = 'cart-toast';
    toast.innerHTML = `<span>${message}</span>`;
    document.body.appendChild(toast);
    setTimeout(() => { toast.remove(); }, 2700);
}

document.addEventListener('DOMContentLoaded', () => { chargerPlats(''); });
