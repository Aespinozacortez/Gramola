var playlistElement = document.getElementById("playlist");
var cancionElement = document.getElementById("Canciones");
var audioPlayer = document.getElementById("audioPlayer");
var infoimg = document.getElementById("infoimg");
console.log(cancionesData)
playlistElement.addEventListener("click", function(event) {
    if (event.target && event.target.tagName === "A") {     // Si hacemos click al div  y no es a una playlist se borran las canciones.
                                                            // Con esto comparamos el click si es un elemento html <a> se muestran las canciones

        event.preventDefault();         // Evitamos que al hacer click a una playlist nos mande a otra pagina

        var playlistName = event.target.textContent;    // Pilla el nombre de la lista de reproducción al hacer click en una de ellas
        var songs = cancionesData[playlistName];        // conseguimos las canciones de la lista seleccionada

        cancionElement.innerHTML = "";          // Limpiamos el div Canciones para mostrar otras canciones de una playlist diferente
        songs.forEach(function(song) {          // Crear y agregar elementos para cada canción

            var songDiv = document.createElement("div");
            songDiv.id = "Cancion";         // cada div lo creamos con este id

            var img = document.createElement("img");
            img.src = song.image;

            var infoDiv = document.createElement("div");
            infoDiv.id = "info";    //cada div lo creamos con este id

            var tituloP = document.createElement("p");
            tituloP.id = "titulo";
            tituloP.textContent = song.Title;

            var autorP = document.createElement("p");
            autorP.id = "autor";
            autorP.textContent = song.Artist;

            var durationP = document.createElement("p");
            durationP.id = "duration";
            durationP.textContent = song.Duration;

            songDiv.addEventListener("click", function() {
        
                audioPlayer.src = song.Song;       // Actualiza la fuente del elemento de audio para reproducir la canción
                audioPlayer.load();
                audioPlayer.play();         // Reproduce la canción al hacer clic

                var tituloP = document.createElement("p");
                tituloP.id = "titulo";
                tituloP.textContent = song.Title;

                var autorP = document.createElement("p");
                autorP.id = "autor";
                autorP.textContent = song.Artist;

                var infoDiv = document.createElement("div");
                infoDiv.id = "texto";

                var img = document.createElement("img");
                img.src = song.image;

                infoDiv.appendChild(tituloP);
                infoDiv.appendChild(autorP);
                infoimg.innerHTML = ""; 
                infoimg.appendChild(img);
                infoimg.appendChild(infoDiv);
                
            });

            infoDiv.appendChild(tituloP);          //hacemos que el titulo este debajo del div info
            infoDiv.appendChild(autorP);           //hacemos que el autor este debajo del div info
            

            songDiv.appendChild(img);              //hacemos que el img este debajo del div cancion
            songDiv.appendChild(infoDiv);          //hacemos que el div info este debajo del div cancion
            songDiv.appendChild(durationP);

            cancionElement.appendChild(songDiv);    // Añadimos el div Cancion como hijo del div Canciones para poder mostrar las canciones
        });
    }
});

/* BOTON PAUSA Y PLAY
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

*/