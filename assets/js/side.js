
document.addEventListener("DOMContentLoaded", function () {
    const sidebarLinks = document.querySelectorAll(".sidebar-nav .nav-content a");

    // Fonction pour enlever la classe active de tous les liens
    function removeActiveClass() {
        sidebarLinks.forEach(link => link.classList.remove("active"));
    }

    // Récupérer le lien actif depuis le stockage local
    const activeLink = localStorage.getItem("activeSidebarLink");
    if (activeLink) {
        const link = document.querySelector(`.sidebar-nav .nav-content a[href='${activeLink}']`);
        if (link) {
            link.classList.add("active");
            link.closest(".nav-content").classList.add("show"); // Ouvrir le menu parent si nécessaire
        }
    }

    sidebarLinks.forEach(link => {
        link.addEventListener("click", function () {
            removeActiveClass();
            this.classList.add("active");
            localStorage.setItem("activeSidebarLink", this.getAttribute("href"));
        });
    });
});

