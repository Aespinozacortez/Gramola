var playlistElement = document.getElementById("playlist");
var cancionElement = document.getElementById("Canciones");
var audioPlayer = document.getElementById("audioPlayer");
var infoimg = document.getElementById("infoimg");
var nextButton = document.getElementById("Siguiente");
var beforeButton = document.getElementById("Anterior");
var randomButton = document.getElementById("aleatorio");
var playButton = document.getElementById("play");
var imgChange = document.getElementById("imgchange");
var currentPlaylistName = null; // Variable para almacenar el nombre de la lista de reproducción actual
var currentIndex = 0; // Variable para almacenar el índice de la canción actual
var songs = [];
var max = 0; // Suponiendo que "songs" es tu array de canciones



playlistElement.addEventListener("click", function(event) {
    if (event.target && event.target.tagName === "A") {
        event.preventDefault();
        currentPlaylistName = event.target.textContent;
        songs = cancionesData[currentPlaylistName];
        currentIndex = 0;
        cancionElement.innerHTML = "";
        loadSongs();
        console.log(songs)
    }
});


function loadSongs() {
    cancionElement.innerHTML = "";
    songs.forEach(function(song) {
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
        var durationP = document.createElement("p");
        durationP.id = "duration";
        durationP.textContent = song.Duration;

        songDiv.addEventListener("click", function() {
            nextButton.disabled = false;
            currentIndex = songs.indexOf(song);
            audioPlayer.src = song.Song;
            audioPlayer.load();
            audioPlayer.play();
            imgChange.src = "./img/pause.png";
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
            audioPlayer.addEventListener("ended", playNextSong);
        });

        infoDiv.appendChild(tituloP);
        infoDiv.appendChild(autorP);

        songDiv.appendChild(img);
        songDiv.appendChild(infoDiv);
        songDiv.appendChild(durationP);

        cancionElement.appendChild(songDiv);
    });
}


function playNextSong() {
    if (currentIndex +1 >= songs.length) {
        console.log(currentIndex)
        console.log(songs.length)
        console.log("No hay más canciones disponibles.");
        nextButton.disabled = true;
    } else {
        currentIndex++;
        audioPlayer.src = songs[currentIndex].Song;
        audioPlayer.load();
        audioPlayer.play();

        // Actualiza la información de la canción
        var tituloP = document.createElement("p");
            tituloP.id = "titulo";
            tituloP.textContent = songs[currentIndex].Title
            var autorP = document.createElement("p");
            autorP.id = "autor";
            autorP.textContent = songs[currentIndex].Artist;
            var infoDiv = document.createElement("div");
            infoDiv.id = "texto";
            var img = document.createElement("img");
            img.src = songs[currentIndex].image;;
            infoDiv.appendChild(tituloP);
            infoDiv.appendChild(autorP);
            infoimg.innerHTML = "";
            infoimg.appendChild(img);
            infoimg.appendChild(infoDiv);
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
        audioPlayer.load();
        audioPlayer.play();
        var tituloP = document.createElement("p");
            tituloP.id = "titulo";
            tituloP.textContent = songs[currentIndex].Title
            var autorP = document.createElement("p");
            autorP.id = "autor";
            autorP.textContent = songs[currentIndex].Artist;
            var infoDiv = document.createElement("div");
            infoDiv.id = "texto";
            var img = document.createElement("img");
            img.src = songs[currentIndex].image;;
            infoDiv.appendChild(tituloP);
            infoDiv.appendChild(autorP);
            infoimg.innerHTML = "";
            infoimg.appendChild(img);
            infoimg.appendChild(infoDiv);
    }
}

function randomsong() { 
    max = songs.length

    var randomIndex = Math.floor(Math.random() * max);
    currentIndex = randomIndex
    
    if (currentIndex >= 0 & currentIndex < songs.length ) {
        audioPlayer.src = songs[currentIndex].Song;
        audioPlayer.load();
        audioPlayer.play();
        console.log(currentIndex +" -- "+songs[currentIndex].Title)
        var tituloP = document.createElement("p");
        tituloP.id = "titulo";
        tituloP.textContent = songs[currentIndex].Title
        var autorP = document.createElement("p");
        autorP.id = "autor";
        autorP.textContent = songs[currentIndex].Artist;
        var infoDiv = document.createElement("div");
        infoDiv.id = "texto";
        var img = document.createElement("img");
        img.src = songs[currentIndex].image;;
        infoDiv.appendChild(tituloP);
        infoDiv.appendChild(autorP);
        infoimg.innerHTML = "";
        infoimg.appendChild(img);
        infoimg.appendChild(infoDiv); 
    }
}
function playstopSong() {
    if (audioPlayer.paused) {
        audioPlayer.play();
        imgChange.src = "./img/pause.png";
    } else {
        audioPlayer.pause();
        imgChange.src = "./img/play.png";
    }
}

playButton.addEventListener("click", playstopSong);
randomButton.addEventListener("click", randomsong);
beforeButton.addEventListener("click", beforeSong);
nextButton.addEventListener("click", playNextSong);


// BARRA DE DURACION
    const progressBar = document.getElementById('progressBar');
    const currentTime = document.getElementById('currentTime');
    const duration = document.getElementById('duration');

    audioPlayer.addEventListener('timeupdate', function() {
    const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progressBar.value = progress;
    currentTime.textContent = formatTime(audioPlayer.currentTime);
    });
    audioPlayer.addEventListener('loadedmetadata', function() {
        duration.textContent = formatTime(audioPlayer.duration);
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