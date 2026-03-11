document.addEventListener("DOMContentLoaded", function () {

    // LOGO SPIN ANIMATION
    const topLogo = document.querySelector(".top-logo img");

    if (topLogo) {
        topLogo.style.transition = "transform 1.5s ease";
        topLogo.style.transform = "rotateY(360deg)";
    }


    // HOME BUTTON (REFRESH PAGE)
    const homeBtn = document.getElementById("homeBtn");

    if(homeBtn){
        homeBtn.addEventListener("click", function(e){
            e.preventDefault();

            // scroll to top smoothly
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });

            // refresh after scroll
            setTimeout(function(){
                location.reload();
            }, 600);
        });
    }


    // LOGO1 CLICK = REFRESH
    const logo1 = document.querySelector(".logo1");

    if(logo1){
        logo1.addEventListener("click", function(){
            location.reload();
        });
    }


    // SCROLL TO ABOUT
    const aboutBtn = document.getElementById("aboutBtn");
    const aboutSection = document.querySelector(".about");

    if(aboutBtn){
        aboutBtn.addEventListener("click", function(e){
            e.preventDefault();

            aboutSection.scrollIntoView({
                behavior: "smooth"
            });
        });
    }


    // SCROLL TO CONTACT
    const contactBtn = document.getElementById("contactBtn");
    const contactSection = document.querySelector(".contact");

    if(contactBtn){
        contactBtn.addEventListener("click", function(e){
            e.preventDefault();

            contactSection.scrollIntoView({
                behavior: "smooth"
            });
        });
    }

});