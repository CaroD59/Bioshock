function ToggleMenu() {
  const navbar = document.getElementById('bloc-liens');
  const toggle = document.getElementById('button-burger');
  const img = document.getElementById('burger');

  toggle.addEventListener('click', (e) => {
    navbar.classList.toggle('show-list');
    if (navbar.classList.contains('show-list')) {
      img.src = 'assets/img/Site/cross.png';
    } else {
      img.src = 'assets/img/Site/burger.png';
    }
  });
}

ToggleMenu();
