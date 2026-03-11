    function closePopup() {
        window.location.href = "/BMS/index.php";
    }

    function closeToast() {
        const toast = document.getElementById("toast");
        if (toast) {
            toast.classList.remove("show");
        }
    }

    window.addEventListener("load", function () {
        const params = new URLSearchParams(window.location.search);

        const popup = document.getElementById("popup-message");
        const popupTitle = document.getElementById("popup-title");
        const popupText = document.getElementById("popup-text");

        if (params.get("reset") === "sent") {
            popupTitle.innerText = "Password Reset";
            popupText.innerHTML = "We will be sending you a confirmation email shortly.<br>Please check your inbox or spam.";
            popup.style.display = "flex";
        }

        if (params.get("register") === "pending") {
            popupTitle.innerText = "Registration Submitted";
            popupText.innerHTML = "Your account is still on hold. Please wait for the admin at least 24 hours to approve your account.<br><br>You may receive a notification via SMS or email.";
            popup.style.display = "flex";
        }

        const toast = document.getElementById("toast");
        if (toast) {
            setTimeout(function () {
                toast.classList.remove("show");
            }, 60000);
        }
    });