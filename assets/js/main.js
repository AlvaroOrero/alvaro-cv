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

// Reseñas: pila de tarjetas con botones anterior / siguiente, flechas del teclado y gesto de deslizar
document.querySelectorAll('[data-resenas]').forEach((carrusel) => {
	const tarjetas = [...carrusel.querySelectorAll('.resena')];
	const total = tarjetas.length;
	const contador = carrusel.querySelector('[data-actual]');
	const pila = carrusel.querySelector('.resenas__pila');
	let actual = 0;
	let ocupado = false;

	function pintar() {
		tarjetas.forEach((tarjeta, i) => {
			const pos = (i - actual + total) % total;
			tarjeta.dataset.pos = Math.min(pos, 3);
			const delante = pos === 0;
			tarjeta.setAttribute('aria-hidden', String(!delante));
			tarjeta.inert = !delante;
		});
		if (contador) contador.textContent = String(actual + 1).padStart(2, '0');
	}

	function mover(dir) {
		if (total < 2 || ocupado) return;
		ocupado = true;
		const saliente = tarjetas[actual];
		saliente.classList.add(dir > 0 ? 'is-saliendo' : 'is-saliendo-der');

		setTimeout(() => {
			actual = (actual + dir + total) % total;
			saliente.classList.remove('is-saliendo', 'is-saliendo-der');
			pintar();
			setTimeout(() => { ocupado = false; }, 450);
		}, 380);
	}

	carrusel.querySelectorAll('.resenas__btn').forEach((boton) => {
		boton.addEventListener('click', () => mover(Number(boton.dataset.dir)));
	});

	pila.addEventListener('keydown', (e) => {
		if (e.key === 'ArrowRight') mover(1);
		if (e.key === 'ArrowLeft') mover(-1);
	});

	let inicioX = null;
	pila.addEventListener('pointerdown', (e) => { inicioX = e.clientX; });
	pila.addEventListener('pointerup', (e) => {
		if (inicioX === null) return;
		const distancia = e.clientX - inicioX;
		if (Math.abs(distancia) > 40) mover(distancia < 0 ? 1 : -1);
		inicioX = null;
	});

	pintar();
});
