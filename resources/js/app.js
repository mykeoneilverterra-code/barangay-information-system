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

document.querySelectorAll('[data-logout-form]').forEach((form) => {
	const trigger = form.querySelector('[data-logout-trigger]');
	const confirmation = form.querySelector('[data-logout-confirmation]');
	const cancel = form.querySelector('[data-logout-cancel]');
	const confirm = form.querySelector('.resident-logout-confirm');

	const openConfirmation = () => {
		confirmation.hidden = false;
		trigger.setAttribute('aria-expanded', 'true');
		cancel.focus();
	};

	const closeConfirmation = () => {
		confirmation.hidden = true;
		trigger.setAttribute('aria-expanded', 'false');
	};

	trigger.addEventListener('click', openConfirmation);

	cancel.addEventListener('click', closeConfirmation);
	confirm.addEventListener('click', () => {
		form.dataset.logoutConfirmed = 'true';
	});

	form.addEventListener('submit', (event) => {
		if (form.dataset.logoutConfirmed !== 'true') {
			event.preventDefault();
			openConfirmation();
			return;
		}

		delete form.dataset.logoutConfirmed;
	});
});
