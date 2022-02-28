let texte = `" Mon nom est Andrew Ryan. Permettez-moi de vous poser une simple question : Ce qu'un homme obtient par le travail à la sueur de son front... Cela ne lui revient-il pas de droit ? 'Non,' répond l'homme de Washington. 'Cela appartient aux pauvres.' 'Non,' répond l'homme du Vatican. 'Cela appartient à Dieu.' 'Non,' dit à son tour l'homme de Moscou. 'Cela appartient au peuple.' Pour ma part, j'ai choisi d'ignorer ces réponses. J'ai choisi une voie différente. J'ai choisi l'impossible. J'ai choisi... Rapture ! "`;
let container = document.getElementById('type-js-auto');
let emplacement = 0;
let stock_texte = '';

function write_text() {
  if (texte[emplacement] == 'µ') {
    stock_texte += '<br>';
  } else {
    stock_texte += texte[emplacement];
  }

  container.innerHTML = stock_texte;

  emplacement += 1;

  if (emplacement >= texte.length) {
    container.innerHTML = stock_texte + "<span class='blink'>|</span>";
    clearInterval(inter);
    emplacement = 0;
  }
}

let inter = setInterval(function () {
  write_text();
}, 50);
