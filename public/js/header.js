document.querySelectorAll('.nav__link').forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('nav__link--active');
    }
});