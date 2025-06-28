$(document).ready(function () {
    //Page Setup

    // Music Setup
    var musicBox = $(".music-box");
    var musicPlayer = $("#musicPlayer")[0];
    function toggleMusics() {
        musicBox.animate({
            opacity: "1",
        });
        if (musicPlayer.paused) {
            musicPlayer.play();
            musicBox.addClass("music-box-rotating");
        } else if (!musicPlayer.paused) {
            musicPlayer.pause();
            musicBox.removeClass("music-box-rotating");
        }
    }

    $(".music-box").click(function () {
        toggleMusics();
    });
});
