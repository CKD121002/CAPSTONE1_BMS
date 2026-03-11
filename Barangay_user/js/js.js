function toggleSidebar() {
  const sidebar = document.getElementById("sidebar");
  sidebar.classList.toggle("collapsed");
}

/* History Filter */

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(".filterbtn");
  const cards = document.querySelectorAll(".historycard");

  buttons.forEach(function (button) {
    button.addEventListener("click", function () {
      /* remove active state */
      buttons.forEach(function (btn) {
        btn.classList.remove("active");
      });

      this.classList.add("active");

      const filter = this.getAttribute("data-filter");

      cards.forEach(function (card) {
        const status = card.getAttribute("data-status");

        if (filter === "all" || filter === status) {
          card.style.display = "flex";
        } else {
          card.style.display = "none";
        }
      });
    });
  });
});
