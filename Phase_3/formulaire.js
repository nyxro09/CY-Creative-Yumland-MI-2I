document.addEventListener("DOMContentLoaded", () => {
    const pwdInput = document.getElementById("password");
    const toggleBtn = document.getElementById("toggle-pwd");
    const charCount = document.getElementById("char-count");

    if (pwdInput && toggleBtn) {
        // 1. Gérer l'affichage/masquage du mot de passe
        toggleBtn.addEventListener("click", () => {
            if (pwdInput.type === "password") {
                pwdInput.type = "text";
                toggleBtn.innerText = "🙈"; // Icône singe/œil fermé
            } else {
                pwdInput.type = "password";
                toggleBtn.innerText = "👁️"; // Icône œil ouvert
            }
        });

        // 2. Gérer le compteur de caractères en temps réel
        if (charCount) {
            pwdInput.addEventListener("input", () => {
                const longueur = pwdInput.value.length;
                charCount.innerText = `${longueur}/20 caractères`;

                // Changement de couleur dynamique (exigences classiques de sécurité)
                if (longueur < 8) {
                    charCount.style.color = "red"; // Trop court
                } else if (longueur > 20) {
                    charCount.style.color = "red"; // Trop long
                } else {
                    charCount.style.color = "green"; // Parfait
                }
            });
        }
    }
    // Afficher un message d'erreur sous un champ
    function afficherErreur(champ, message) {
        const ancienMsg = champ.parentElement.querySelector(".erreur-validation");
        if (ancienMsg) ancienMsg.remove();
        const msgErreur = document.createElement("small");
        msgErreur.className= "erreur-validation";
        msgErreur.style.color="red";
        msgErreur.style.display="block";
        msgErreur.style.marginTop ="4px";
        msgErreur.innerText=message;

        champ.style.border="2px solid red";
        champ.parentElement.appendChild(msgErreur);
    }

    //  Effacer l'erreur d'un champ 
    function effacerErreur(champ) {
        const ancienMsg = champ.parentElement.querySelector(".erreur-validation");
        if (ancienMsg) ancienMsg.remove();
        champ.style.border = "";
    }

     // Valider le format de l'email 
    function validerEmail(valeur) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;
        return regex.test(valeur);
    }

    // Branchement sur le champ email
    const emailInput = document.getElementById("email");
    if (emailInput) {
        // Feedback en temps réel pendant la saisie
        emailInput.addEventListener("input", () => {
            if (emailInput.value.length > 0 && !validerEmail(emailInput.value)) {
                afficherErreur(emailInput, "Format d'email invalide (ex: nom@domaine.fr)");
            } else {
                effacerErreur(emailInput);
            }
        });
    }

    // Valider la date de naissance
    function validerDate(valeur) {
        if (!valeur) return { ok: false, message: "Veuillez renseigner votre date de naissance." };
        const dateNaissance = new Date(valeur);
        const aujourdhui = new Date();
        if (dateNaissance >= aujourdhui) {
            return { ok: false, message: "La date de naissance ne peut pas être dans le futur." };
        }
        const dateMinimum = new Date();
        dateMinimum.setFullYear(dateMinimum.getFullYear() - 10);
        if (dateNaissance > dateMinimum) {
            return { ok: false, message: "Vous devez avoir au moins 10 ans pour vous inscrire." };
        }
        return { ok: true };
    }

    //  Validation au moment du submit
    const form = document.querySelector("form");
    if (form) {
        form.addEventListener("submit", (e) => {
            let formulaireValide = true;
            //Vérification de l'email
            if (emailInput && !validerEmail(emailInput.value)) {
                afficherErreur(emailInput, "Veuillez saisir une adresse email valide (ex: nom@domaine.fr).");
               formulaireValide = false;
            }
            // Vérification de la date
            const dateInput = document.querySelector("input[type='date']");
            if (dateInput) {
                const resultat = validerDate(dateInput.value);
                if (!resultat.ok) {
                    afficherErreur(dateInput, resultat.message);
                    formulaireValide = false;
                } else {
                    effacerErreur(dateInput);
                }
            }

            // Bloque si erreur
            if (!formulaireValide) {
                e.preventDefault();
            }
        });
    }
});
