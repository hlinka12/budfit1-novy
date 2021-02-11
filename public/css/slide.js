const navBarSlide = () => {
    const burger = document.querySelector('.burger');
    const navBar = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');
    //vysunutie navbaru
    burger.addEventListener('click', () => {
        navBar.classList.toggle('nav-active');
    });
    //delay
    navLinks.forEach((link) => {
        link.style.animation = `navLinkFade 4.0s ease forwards`;
    });
}
navBarSlide();  