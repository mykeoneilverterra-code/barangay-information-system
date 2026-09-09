import './bootstrap';

const sidebar = document.querySelector('.app-sidebar');
const backdrop = document.querySelector('.sidebar-backdrop');
const openButton = document.querySelector('[data-sidebar-open]');
const closeButtons = document.querySelectorAll('[data-sidebar-close]');
const sidebarLinks = document.querySelectorAll('[data-sidebar-link]');

const setSidebarOpen = (isOpen) => {
	sidebar?.classList.toggle('is-open', isOpen);
	backdrop?.classList.toggle('is-visible', isOpen);
	openButton?.setAttribute('aria-expanded', String(isOpen));
	document.body.classList.toggle('sidebar-is-open', isOpen);
};

openButton?.addEventListener('click', () => setSidebarOpen(true));
closeButtons.forEach((button) => button.addEventListener('click', () => setSidebarOpen(false)));
sidebarLinks.forEach((link) => link.addEventListener('click', () => setSidebarOpen(false)));
