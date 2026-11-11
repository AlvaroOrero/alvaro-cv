# Álvaro CV · tema de WordPress

Tema propio para [alvaroorerogimeno.com](https://alvaroorerogimeno.com), mi CV interactivo como SEO.
Hecho a mano, sin constructores ni plugins de maquetación.

## Qué tiene

- PHP, CSS y JavaScript sin frameworks ni dependencias.
- Tipografías alojadas en local (Aspekta e Inter, licencia SIL OFL).
- Formulario de contacto propio con nonce y campo trampa antispam, sin plugins.
- Pensado para rendimiento: sin jQuery, sin estilos de Gutenberg, JS diferido y fuentes precargadas.
- Accesible: HTML semántico, enlace para saltar al contenido, foco visible y respeto a `prefers-reduced-motion`.

## Estructura

```
├── style.css            cabecera del tema
├── functions.php        carga de recursos, datos de contacto y formulario
├── header.php / footer.php
├── front-page.php       home, compuesta por las secciones de template-parts/
├── page-contacto.php    página de contacto (slug "contacto")
├── template-parts/      hero, quién soy, equipos, herramientas, contacto, círculos
└── assets/              css, js, fuentes e imágenes
```

## Despliegue

Cada push a `main` sube al hosting solo los archivos modificados mediante GitHub Actions
(`.github/workflows/deploy.yml`). Antes de subir, comprueba la sintaxis de todos los PHP:
si hay un error, no se despliega nada.
