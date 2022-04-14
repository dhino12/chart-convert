const menuLinks = document.querySelectorAll(".menu-link");
const containerAside = document.querySelector(".aside-menu");

// menuLinks.forEach((itemMenuLink, i) => {
//     itemMenuLink.addEventListener("click", (e) => {
//         e.target.classList.add("active-menu");
//     });
// });

containerAside.addEventListener("click", (e) => {
    if (e.target.className.includes('menu-link')) { 
        menuLinks.forEach((menuLink) => {
            menuLink.className = "menu-link";
        });

        e.target.classList.add("active-menu");
    }
});
