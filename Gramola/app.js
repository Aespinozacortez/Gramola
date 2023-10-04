var playlistElement = document.getElementById("playlist");
var cancionElement = document.getElementById("Canciones");
var formularioselement = document.getElementById("formularios")
var audioPlayer = document.getElementById("audioPlayer");
var infoimg = document.getElementById("infoimg");
var nextButton = document.getElementById("Siguiente");
var beforeButton = document.getElementById("Anterior");
var randomButton = document.getElementById("aleatorio");
var playButton = document.getElementById("play");
var stopButton = document.getElementById("stop");
var imgChange = document.getElementById("imgchange");
var volumen = document.getElementById("volumen");
var playpausa = Boolean;
var currentPlaylistName = null;
var currentIndex = 0;
var songs = [];
var max = 0; 
songs = musica['playlist']['canciones'];
loadSongs();

function loadSongs() {
    mostrarFormularios();
    cancionElement.innerHTML = "";
    songs.forEach(function(song, index) {
        var songDiv = document.createElement("div");
        songDiv.id = "Cancion";
        var img = document.createElement("img");
        img.src = song.image;
        var infoDiv = document.createElement("div");
        infoDiv.id = "info";
        var tituloP = document.createElement("p");
        tituloP.id = "titulo";
        tituloP.textContent = song.Title;
        var autorP = document.createElement("p");
        autorP.id = "autor";
        autorP.textContent = song.Artist;
        
        //FORMULARIO PARA ELIMINAR CANCION
        var deleteForm = document.createElement("form");
        deleteForm.action = "eliminar_cancion.php"; // Ruta al script PHP de eliminación
        deleteForm.method = "post";
        
        // Crear un campo oculto para almacenar el índice de la canción
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "cancion_index";
        input.value = index; // El índice de la canción a eliminar
        // Crear el botón "Eliminar" para eliminar la canción
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Eliminar";
        deleteButton.className = "delete-button"; // Agregar una clase para identificar el botón    
        // Agregar funcionalidad al botón "Eliminar"
        deleteButton.addEventListener("click", function() {
            // Enviar el formulario cuando se haga clic en el botón "Eliminar"
            deleteForm.submit();
        });

        songDiv.addEventListener("click", function() {
            nextButton.disabled = false;
            currentIndex = songs.indexOf(song);
            audioPlayer.src = song.Song;          
            audioPlayer.play();
            imgChange.src = "./img/pause.png";
            updateSongInfo();
            audioPlayer.addEventListener("ended", playNextSong);  
             
        });
       

       // Agregar el campo oculto y el boton de eliminar cancion
       deleteForm.appendChild(input);
       deleteForm.appendChild(deleteButton);

       infoDiv.appendChild(tituloP);
       infoDiv.appendChild(autorP);
       songDiv.appendChild(img);
       songDiv.appendChild(infoDiv);
       
       // Agregar el formulario al contenedor de canciones
       songDiv.appendChild(deleteForm);

       cancionElement.appendChild(songDiv);


       updateSongInfo();
       audioPlayer.src = songs[currentIndex].Song;
       audioPlayer.addEventListener("ended", playNextSong);
       playpausa = false;
       playstopSong();
           
   });
   playlistElement.addEventListener("click", function() {
    mostrarFormularios(); // Llama a la función para mostrar los formularios
});


}

function mostrarFormularios() {
    var ocultar = document.getElementById("eliminar");
    var ocultar2 = document.getElementById("subircancion");
    subircancion.style.display = "block"; // Cambia el estilo para mostrar el elemento
    ocultar.style.display = "block"; // Cambia el estilo para mostrar el elemento
}

function updateSongInfo() {
    var tituloP = document.createElement("p");
    tituloP.id = "titulo";
    tituloP.textContent = songs[currentIndex].Title;
    var autorP = document.createElement("p");
    autorP.id = "autor";
    autorP.textContent = songs[currentIndex].Artist;
    var infoDiv = document.createElement("div");
    infoDiv.id = "texto";
    var img = document.createElement("img");
    img.src = songs[currentIndex].image;
    infoDiv.appendChild(tituloP);
    infoDiv.appendChild(autorP);
    infoimg.innerHTML = "";
    infoimg.appendChild(img);
    infoimg.appendChild(infoDiv);
}
function playNextSong() {
    if (currentIndex + 1 >= songs.length) {
        console.log("No hay más canciones disponibles.");
        nextButton.disabled = true;
    } else {
        currentIndex++;
        updateSongInfo(); // Actualiza la información de la canción primero
        audioPlayer.src = songs[currentIndex].Song;
        playpausa = true;
        playstopSong();
    }
}
function beforeSong() {
    if (currentIndex <=0) {
        beforeButton.disabled = true;
        console.log("No hay más canciones para volver");
    } else {
        currentIndex--;
        console.log(currentIndex)
        audioPlayer.src = songs[currentIndex].Song;
        playpausa = true;
        playstopSong();
        updateSongInfo();
    }
}
function randomsong() { 
    max = songs.length
    var randomIndex = Math.floor(Math.random() * max);
    currentIndex = randomIndex
    if (currentIndex >= 0 & currentIndex < songs.length ) {
        audioPlayer.src = songs[currentIndex].Song;
        playpausa = true;
        playstopSong();
        updateSongInfo();
    }
}
function playstopSong() {
    if (playpausa) {
        imgChange.src = "./img/pause.png";
        playpausa = false;
        audioPlayer.play();
    } else {
        audioPlayer.pause();
        imgChange.src = "./img/play.png";
        playpausa = true;
    }
}
function stopAudio() {
    playstopSong();
    audioPlayer.currentTime = 0;
    imgChange.src = "./img/play.png";
}

stopButton.addEventListener("click", stopAudio);
playButton.addEventListener("click", playstopSong);
randomButton.addEventListener("click", randomsong);
beforeButton.addEventListener("click", beforeSong);
nextButton.addEventListener("click", playNextSong);
// BARRA DE DURACION
const progressBar = document.getElementById('progressBar');
const currentTime = document.getElementById('currentTime');
const duration = document.getElementById('duration');

audioPlayer.addEventListener('loadedmetadata', function() {
    // Actualiza la duración cuando se carga la metadatos
    duration.textContent = formatTime(audioPlayer.duration);
});

audioPlayer.addEventListener('timeupdate', function() {
    const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progressBar.value = progress;
    currentTime.textContent = formatTime(audioPlayer.currentTime);
});
    function formatTime(time) {
        const minutes = Math.floor(time / 60).toString().padStart(2, '0');
        const seconds = Math.floor(time % 60).toString().padStart(2, '0');
        return `${minutes}:${seconds}`;
        }
    progressBar.addEventListener('click', function(event) {
    const progressBarWidth = progressBar.offsetWidth;
    const clickX = event.offsetX;
    const clickPercentage = (clickX / progressBarWidth) * 100;
    const newTime = (clickPercentage / 100) * audioPlayer.duration;
    audioPlayer.currentTime = newTime;
    });
// VOLUMEN DE LA CANCION
audioPlayer.volume = volumen.value;
volumen.addEventListener("input", function () {
    audioPlayer.volume = volumen.value;
});
