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
/**
 * Handles the display of the success popup based on URL parameters
 */
function handleStatusPopup() {
  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.get("status") === "success") {
    const popup = document.getElementById("successPopup");

    if (popup) {
      // 1. Show the popup (CSS handles the slide-down)
      popup.classList.add("show");

      // 2. Automatically hide it after 5 seconds
      setTimeout(() => {
        popup.classList.remove("show");

        // 3. Clean the URL so the popup doesn't re-trigger on refresh
        const newUrl = window.location.pathname;
        window.history.replaceState({}, document.title, newUrl);
      }, 5000);
    }
  }
}

// Ensure the function runs whenever a page using js.js finishes loading
window.addEventListener("load", handleStatusPopup);
