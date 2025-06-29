$(document).ready(function () {
    //Page Setup

    var musicPlayer = $("#musicPlayer")[0];
    var musicToggleButton = $("#music-toggle-button");

    // Set volume default
    musicPlayer.volume = 0.5;

    function toggleMusic() {
        if (musicPlayer.paused) {
            var playPromise = musicPlayer.play();

            if (playPromise !== undefined) {
                playPromise
                    .then((_) => {
                        musicToggleButton.addClass("playing");
                        musicToggleButton
                            .find("i")
                            .removeClass("fa-music")
                            .addClass("fa-pause");
                    })
                    .catch((error) => {
                        console.error("Playback prevented:", error);
                        // Tampilkan instruksi ke pengguna
                    });
            }
        } else {
            musicPlayer.pause();
            musicToggleButton.removeClass("playing");
            musicToggleButton
                .find("i")
                .removeClass("fa-pause")
                .addClass("fa-music");
        }
    }

    // Event listener untuk tombol musik
    musicToggleButton.on("click", function (e) {
        e.preventDefault();
        toggleMusic();
    });

    // Event listeners untuk status pemutaran
    $(musicPlayer).on("play playing", function () {
        musicToggleButton.addClass("playing");
        musicToggleButton
            .find("i")
            .removeClass("fa-music")
            .addClass("fa-pause");
    });

    $(musicPlayer).on("pause ended", function () {
        musicToggleButton.removeClass("playing");
        musicToggleButton
            .find("i")
            .removeClass("fa-pause")
            .addClass("fa-music");
    });
});
