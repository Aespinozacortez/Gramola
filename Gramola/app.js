var pauseButton = document.querySelector("#play img");
var imgChange = document.getElementById("imgchange");
let isPlaying = false; 

// evento para cambiar botón de pausa/reproducción
pauseButton.addEventListener("click", function() {
    if (isPlaying) {
        imgChange.src = "./img/Play.png";
    } else {
        imgChange.src = "./img/pause.png"; 
    }
    isPlaying = !isPlaying; // Cambia el estado de reproducción
});
// Obtén una referencia a la lista
var miLista = document.getElementById("prueba");

miLista.addEventListener("click", function(event) {
    if (event.target && event.target.tagName === "A") {
        var textoElemento = event.target.textContent;
        
        // Muestra una alerta con el texto del elemento
        alert("Hiciste clic en: " + textoElemento);
    }
});

var nombrePlaylist = datosDesdePHP.playlist.nombre;
console.log(nombrePlaylist); // Esto imprimirá "Electronica" en la consola
