/* ==========================================================
   Álvaro CV · interacciones
   ========================================================== */

// Menú: abrir, cerrar y cerrar al pulsar un enlace o Escape
const botonMenu = document.querySelector('.site-header__menu');
const menu = document.getElementById('menu-principal');

function cerrarMenu() {
	botonMenu.setAttribute('aria-expanded', 'false');
	menu.classList.remove('is-open');
}

if (botonMenu && menu) {
	botonMenu.addEventListener('click', () => {
		const abierto = botonMenu.getAttribute('aria-expanded') === 'true';
		botonMenu.setAttribute('aria-expanded', String(!abierto));
		menu.classList.toggle('is-open', !abierto);
	});
	menu.addEventListener('click', (e) => { if (e.target.closest('a')) cerrarMenu(); });
	document.addEventListener('keydown', (e) => { if (e.key === 'Escape') cerrarMenu(); });
}

// Aparición suave de los bloques al entrar en pantalla
const revelables = document.querySelectorAll('.reveal');

if ('IntersectionObserver' in window) {
	const observador = new IntersectionObserver((entradas) => {
		entradas.forEach((entrada) => {
			if (entrada.isIntersecting) {
				entrada.target.classList.add('is-visible');
				observador.unobserve(entrada.target);
			}
		});
	}, { threshold: 0.15 });

	revelables.forEach((el) => observador.observe(el));
} else {
	revelables.forEach((el) => el.classList.add('is-visible'));
}

// WhatsApp: abre el chat con lo que la persona haya escrito ya en el formulario
const botonWhatsapp = document.querySelector('.js-whatsapp');
const formulario = document.getElementById('formulario');

if (botonWhatsapp && formulario) {
	botonWhatsapp.addEventListener('click', (e) => {
		const campo = (nombre) => (formulario.elements[nombre]?.value || '').trim();
		const partes = [
			campo('nombre') && `Hola Álvaro, soy ${campo('nombre')}.`,
			campo('interes') && `Me interesa: ${campo('interes')}.`,
			campo('mensaje'),
			campo('web') && `Mi web: ${campo('web')}`,
		].filter(Boolean);

		if (partes.length) {
			e.preventDefault();
			const texto = encodeURIComponent(partes.join('\n'));
			window.open(`https://wa.me/${botonWhatsapp.dataset.numero}?text=${texto}`, '_blank', 'noopener');
		}
	});
}
