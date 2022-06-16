const menuLinks = document.querySelectorAll(".menu-link");
const containerAside = document.querySelector(".aside-menu");
const canvasGrafik = document.querySelector('#canvas-grafik')
const btnStratchs = document.querySelectorAll('#btn-stratch');
const wrapCanvas = document.querySelectorAll('#wrapper-canvas');
const buttonStatus = document.querySelector("#status");
console.log(buttonStatus);
let indicator = true;

containerAside.addEventListener("click", (e) => {
    if (e.target.className.includes('menu-link')) {
        menuLinks.forEach((menuLink) => {
            menuLink.className = "menu-link";
        });

        e.target.classList.add("active-menu");
    }
});

function toggleStracth(btnStratchs, i) {
    if (btnStratchs.target.className.includes('bg-light')) {
        btnStratchs.target.classList.remove('bg-light');
        wrapCanvas[i].classList.replace('col-xl-12', 'col-xl-6');
        console.log('masuk if');

    } else {
        btnStratchs.target.classList.add('bg-light');
        wrapCanvas[i].classList.replace('col-xl-6', 'col-xl-12');
    }
}

btnStratchs.forEach((e, i) => {
    e.addEventListener('click', (e) => {
        e.preventDefault();
        toggleStracth(e, i);
    })
})

buttonStatus.addEventListener('click', () => {
    if (indicator){
        buttonStatus.classList.replace('btn-danger', 'btn-success');
        buttonStatus.value = "active"
        indicator = false;
    } else {
        buttonStatus.classList.replace('btn-success', 'btn-danger');
        buttonStatus.value = "unactive"
        indicator = true;
    }
})