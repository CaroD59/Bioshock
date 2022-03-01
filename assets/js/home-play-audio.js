// PLAY

const play = document.getElementById('play-audio');
const audio = document.getElementById('audio');
const sister = document.getElementById('sister');

play.addEventListener('click', function (e) {
  e.preventDefault();
  audio.play();
  sister.classList.toggle('sister-view');
});

// PAUSE

const pause = document.getElementById('pause-audio');

pause.addEventListener('click', function (e) {
  e.preventDefault();
  audio.pause();
});
