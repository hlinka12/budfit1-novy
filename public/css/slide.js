const navBarSlide = () => {
    const burger = document.querySelector('.burger');
    const navBar = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');

    burger.addEventListener('click', () => {
        navBar.classList.toggle('nav-active');
    });
    navLinks.forEach((link) => {
        link.style.animation = `navLinkFade 0.5s ease forwards`;
    });
}
navBarSlide();  