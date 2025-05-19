const generos = document.querySelectorAll('.generos');
const plataformas = document.querySelectorAll('.plataformas');
const juegos = document.querySelectorAll('.juego');
const btnFiltro = document.getElementById('btnFiltro');

btnFiltro.addEventListener('click', function() {
    juegos.forEach(juego => {

        let generosActivos = [];
        let plataformasActivos = [];

        // Limpiar estilos de los juegos
        juego.style.display = 'block';

        // Por cada genero y plataforma, si está activo, lo añadimos a su respectivo array
        generos.forEach(genero => {
            if (genero.checked) {
                generosActivos.push(genero.value);
            }
        });

        plataformas.forEach(plataforma => {
            if (plataforma.checked) {
                plataformasActivos.push(plataforma.value);
            }
        });

        // Obtener los generos y plataformas del juego en un array para cada uno
        const generosJuego = juego.getAttribute('generos').split(' ');
        const plataformasJuego = juego.getAttribute('plataformas').split(' ');

        // Si hay generos o plataformas activos, comprobar si el juego tiene los generos y plataformas seleccionados
        if (generosActivos.length > 0 || plataformasActivos.length > 0) {
            const tieneGenero = generosActivos.every(genero => generosJuego.includes(genero));
            const tienePlataforma = plataformasActivos.every(plataforma => plataformasJuego.includes(plataforma));

            // Si el juego tiene los generos y plataformas seleccionados, mostrarlo, sino ocultarlo
            if (tieneGenero && tienePlataforma) {
                juego.style.display = 'block';
            } else {
                juego.style.display = 'none';
            }
        }
    });
});