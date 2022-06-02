const sideBar = document.querySelector('#offcanvasNavbar');
const toggleSideBar = document.querySelector('#toggle');
const headerBrand = document.querySelector('.header-brand');
const contentWrapper = document.querySelector('#content-wrapper');

toggleSideBar.onclick = () => {
    sideBar.classList.toggle("active");
    headerBrand.classList.toggle("active");
    contentWrapper.classList.toggle('active');
}