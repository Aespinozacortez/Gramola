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