function closePopup() {
    const popup = document.getElementById("popup-message");
    if (popup) {
        popup.style.display = "none";
    }

    const url = new URL(window.location.href);
    url.searchParams.delete("reset");
    window.history.replaceState({}, document.title, url.pathname + (url.search ? url.search : ""));
}

function closeToast() {
    const toast = document.getElementById("toast");
    if (toast) {
        toast.classList.remove("show");
    }

    const url = new URL(window.location.href);
    url.searchParams.delete("error");
    window.history.replaceState({}, document.title, url.pathname + (url.search ? url.search : ""));
}

function closeRegisterPopup() {
    const popup = document.getElementById("register-popup");
    if (popup) {
        popup.style.display = "none";
        popup.classList.remove("show");
    }

    const url = new URL(window.location.href);
    url.searchParams.delete("register");
    window.history.replaceState({}, document.title, url.pathname + (url.search ? url.search : ""));
}

window.addEventListener("load", function () {
    const params = new URLSearchParams(window.location.search);

    const popup = document.getElementById("popup-message");
    const popupTitle = document.getElementById("popup-title");
    const popupText = document.getElementById("popup-text");

    if (params.get("reset") === "sent" && popup) {
        popupTitle.innerText = "Password Reset";
        popupText.innerHTML = "We will be sending you a confirmation email shortly.<br>Please check your inbox or spam.";
        popup.style.display = "flex";
    }

    const toast = document.getElementById("toast");
    if (toast) {
        setTimeout(function () {
            toast.classList.remove("show");
        }, 60000);
    }
});