document.addEventListener("DOMContentLoaded", () => {
    const themeToggleBtn = document.getElementById("theme-toggle");
    
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener("click", () => {
            // 1. On bascule la classe dark-theme sur le body
            document.body.classList.toggle("dark-theme");
            
            // 2. On vérifie si le mode sombre est maintenant actif
            const estSombre = document.body.classList.contains("dark-theme");
            
            // 3. On change l'icône du bouton en direct (Soleil si sombre, Lune si clair)
            themeToggleBtn.innerText = estSombre ? "☀️" : "🌙";
            
            // 4. On enregistre le choix dans un Cookie valide pour 365 jours
            document.cookie = `theme=${estSombre ? 'dark' : 'light'}; max-age=${365 * 24 * 60 * 60}; path=/; SameSite=Lax`;
        });
    }
});