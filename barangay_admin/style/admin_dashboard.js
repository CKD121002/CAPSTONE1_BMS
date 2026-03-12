document.addEventListener("DOMContentLoaded", function () {

    /* =========================
    SIDEBAR TOGGLE
    ========================= */

    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
        });
    }

    /* =========================
    SUBMENU TOGGLE
    ========================= */

    document.querySelectorAll(".submenu-toggle").forEach(function (toggle) {
        toggle.addEventListener("click", function () {
            this.parentElement.classList.toggle("open");
            
        });
    });



 });

 