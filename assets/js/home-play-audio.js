// PLAY

const play = document.getElementById('play-audio');
const audio = document.getElementById('audio');

play.addEventListener('click', function (e) {
  e.preventDefault();
  audio.play();
});

// PAUSE

const pause = document.getElementById('pause-audio');

pause.addEventListener('click', function (e) {
  e.preventDefault();
  audio.pause();
});
