const toggle = document.querySelector("#menu-primary-toggle");
const menu = document.querySelector("#menu-primary-menu");
const toggleMenu = () => {
	toggle.classList.toggle("open");
	menu.classList.toggle("show");
};

toggle.addEventListener("click", toggleMenu);
