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
});