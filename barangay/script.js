document.addEventListener("DOMContentLoaded", function () {

    // =========================
    // SIDEBAR TOGGLE
    // =========================
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            sidebar.classList.toggle("collapsed");
        });
    }

    // =========================
    // SUBMENU TOGGLE
    // =========================
    document.querySelectorAll(".submenu-toggle").forEach(function (toggle) {
        toggle.addEventListener("click", function () {
            this.parentElement.classList.toggle("open");
        });
    });

    // =========================
    // CHARTS (ONLY IF EXIST)
    // =========================

    const populationCanvas = document.getElementById("populationChart");
    const ageCanvas = document.getElementById("ageChart");

    if (populationCanvas) {
    new Chart(populationCanvas, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                data: [populationMale, populationFemale],
                backgroundColor: ['#36A2EB', '#FF6384']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'top' }
            }
        }
    });
}

if (ageCanvas) {
    new Chart(ageCanvas, {
        type: 'doughnut',
        data: {
            labels: ['Child', 'Teen', 'Adult', 'Senior'],
            datasets: [{
                data: [ageChild, ageTeen, ageAdult, ageSenior],
                backgroundColor: ['#4CAF50', '#FFC107', '#2196F3', '#9C27B0']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: { position: 'top' }
            }
        }
        
    });
}


});



