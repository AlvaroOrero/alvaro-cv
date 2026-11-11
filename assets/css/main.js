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

// Cursor personalizado: círculo blanco con mix-blend-mode "difference" que invierte lo que tiene debajo.
// Solo en dispositivos con ratón; en móvil y tablet no se crea.
if (window.matchMedia('(pointer: fine)').matches) {
	const cursor = document.createElement('div');
	cursor.className = 'cursor';
	cursor.setAttribute('aria-hidden', 'true');
	cursor.innerHTML = '<span class="cursor__punto"></span>';
	document.body.appendChild(cursor);
	document.documentElement.classList.add('cursor-activo');

	const sinMovimiento = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	const suavizado = sinMovimiento ? 1 : 0.2; // 1 = sigue al ratón sin retardo
	let ratonX = -100, ratonY = -100, x = -100, y = -100;

	window.addEventListener('mousemove', (e) => {
		ratonX = e.clientX;
		ratonY = e.clientY;
		cursor.classList.add('is-visible');
	}, { passive: true });

	document.addEventListener('mouseleave', () => cursor.classList.remove('is-visible'));
	window.addEventListener('mousedown', () => cursor.classList.add('is-pulsado'));
	window.addEventListener('mouseup', () => cursor.classList.remove('is-pulsado'));

	// Crece sobre enlaces y botones; se oculta en campos de texto para dejar ver el cursor de escritura
	document.addEventListener('mouseover', (e) => {
		const objetivo = e.target;
		cursor.classList.toggle('is-grande', !!objetivo.closest('a, button, [role="button"], label'));
		cursor.classList.toggle('is-oculto', !!objetivo.closest('input, textarea, select'));
	});

	(function animar() {
		x += (ratonX - x) * suavizado;
		y += (ratonY - y) * suavizado;
		cursor.style.transform = `translate3d(${x}px, ${y}px, 0)`;
		requestAnimationFrame(animar);
	})();
}
