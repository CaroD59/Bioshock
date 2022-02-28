<head>
<link rel="stylesheet" href="assets/css/home.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    
<main>

<section id="section1">

<!-- BLOC BIENVENUE -->

<div class="welcome">
<?php
    if( $verif_co != 0 ){
?>
    <h1 class ="bjr_prenom"><span id="co_prenom"><?php echo  $_SESSION["logged_in"]["prenom"]; ?></span>,</h1>
    <h1 class ="bjr_prenom">bienvenue a</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>
            
<?php 
    }else if( $verif_co == 0){
?>

    <!-- <h1 class="bjr_pseudo"><?php echo "Bonjour " ; ?></h1> -->
    <h1 class ="bjr_prenom">Bienvenue a</h1>
    <div>
        <img src="assets/img/Site/rapture.png" alt="" class="img__rapture">
    </div>

<?php 
}
?>  
</div>  

<!-- BLOC CARROUSEL -->

<!-- BLOC DESCRIPTION SITE -->

<div data-aos="fade-down">
    <h2>Qu'est-ce donc <span class="andrew-ryan">Rapture</span> ?</h2>
</div>

<div class="Description-Bloc" data-aos="fade-down">
 <div class="text">
    <p>
         Description
    </p>
 </div>
 <div class="img1">
    <img src="assets/img/Site/rapture-description.jpg" alt="" class="imgs-description">
 </div>
</div>

<!-- BLOC ANDREW RYAN -->

<div data-aos="fade-down">
    <h2>Qui est <span class="andrew-ryan">Andrew Ryan</span> ?</h2>
</div>

<div class="Ryan-Bloc" data-aos="fade-down">
    <div class="Ryan">
    <div class="img-ryan">
        <img src="assets/img/Site/ryan.jpg" alt="" class="ryan-img">
    </div>
    <div class="img-record">
        <img src="assets/img/Site/audio.png" alt="" class="audio-png">
        <p class="play-me">Jouez moi</p>
    <div class="audios">
        <img src="assets/img/Site/play.png" alt="" class="play-audio" id="play-audio">
        <img src="assets/img/Site/pause.png" alt="" class="play-audio" id="pause-audio">
        <audio src="assets/sons/ryan-speech.mp3" id="audio"></audio>
    </div>
    </div>
    </div>
    <div class="description">
    <p class="typewriter" id="type-js-auto"></p>
    <p class="description-ryan"><span class="span-ryan">Andrew Ryan</span> est né en 1892 dans un petit village proche de Minsk, en Russie, sous le nom d’Andrei Ryanovski. En 1917, il est témoin de la <span class="span-ryan">violente Révolution qui secoue l’Empire russe</span>, et voit toute sa famille se faire assassiner par des agents de l’Etat. Les événements vécus dans son pays d’origine <span class="span-ryan">façonnèrent la base de sa philosophie objectiviste</span>. Ryan est en effet convaincu que le monde moderne est le fruit de grands hommes qui ont tout donné pour matérialiser leurs rêves, et que quelques « parasites » – souvent des hommes politiques – suffisent à renverser ce monde. Il fuit son pays d’origine pour rejoindre l’Angleterre et intégrer par la suite l’Université d’Oxford, pour finalement <span class="span-ryan">émigrer aux États-Unis en 1919</span>, changeant son nom en Andrew Ryan.</p>
    <p class="description-ryan">L’Amérique était pour Ryan le lieu où tout homme décidé à réussir devait se trouver. Il fonde Ryan Industries, une importante société du secteur de l’acier et de l’armement. Pendant un temps totalement <span class="span-ryan">dévoué à son pays d’adoption</span>, pays qui lui a permis, sur la seule base de son intelligence et de sa volonté, de devenir un self-made man exemplaire, Ryan verra néanmoins <span class="span-ryan">ses espoirs s’envoler rapidement</span>. En effet, le plus jeune milliardaire du monde, selon un titre donné par « Life Magazine » en 1932, ne supportera pas <span class="span-ryan">la politique sociale des Etats-Unis des années 30</span>, issue du keynésianisme. <span class="span-ryan">Pour lui, on ne mérite de posséder que ce que l’on gagne</span>, et bénéficier du travail des autres sans y contribuer relève du « <span class="span-ryan">parasitage</span> ».</p>
    <p class="description-ryan">Ce <span class="span-ryan">capitalisme individualiste</span> et ce <span class="span-ryan">libertarianisme</span> prônant le mérite, la raison et l’ «<span class="span-ryan">égoïsme rationnel</span>» sont tous deux le fruit d’Ayn Rand. Considérée comme la théoricienne de ces deux concepts, elle est profondément marquée par sa jeunesse en Russie, et s’affiche comme une anti-communiste radicale. L’ensemble de ces points sont bien entendu communs avec l’histoire et le caractère d’Andrew Ryan. Ce dernier a néanmoins <span class="span-ryan">sa propre philosophie économique</span>, la <span class="span-ryan">Grande Chaîne de l’industrie</span>, qui, semblable à la métaphore d’<span class="span-ryan">Adam Smith</span> nommé la « main invisible du marché », représente <span class="span-ryan">chaque maillon de la société comme liés entre eux par un lien intangible d’inter-relations économiques.</span></p>
    <p class="description-ryan">Le tempérament et la force des convictions d’Andrew Ryan peuvent être illustrés par une affaire l’opposant à l’Etat : propriétaire d’une forêt que le gouvernement souhaitait nationaliser dans le but d’en faire un parc, il la brûla entièrement avant de s’en séparer afin que les « parasites » ne profitent pas de ce qui lui appartenait. La réelle rupture se fait lors du largage de la bombe atomique sur Hiroshima. Ryan voit en cet acte la souillure ultime de ses idéaux, les « parasites » exploitant la science pour détruire ce qu’ils ne pouvaient acquérir.</p>
    <p class="description-ryan">En réponse, Ryan use de sa fortune pour concevoir <span class="span-ryan">Rapture</span>. Sous le couvert de l’entreprise <span class="span-ryan">Warden Yarn</span> (une anagramme de son nom), il entreprend la construction de cette ville. Censée exprimer les idéaux de son concepteur, <span class="span-ryan">Rapture doit rester à l’abri des « parasites »</span>. Pour ce faire, Ryan choisit comme emplacement <span class="span-ryan">les profondeurs de l’Océan Atlantique</span>. Pour peupler sa cité, Andrew Ryan<span class="span-ryan"> invite quelques milliers de personnes parmi les plus grands et les plus brillants</span> de ce monde, afin de créer une communauté où « <span class="span-ryan">l’artiste ne craindrait pas les foudres du censeur, où le scientifique ne serait pas inhibé par une éthique aussi artificielle que vaine, où le Grand ne serait plus humilié par le Petit</span> ». En bon mégalomane, Andrew Ryan n’oublie pas sa propre personne et institue un<span class="span-ryan"> culte de la personnalité</span>, se proclamant héros de Rapture. À l’achèvement de la création de Rapture, Ryan n’a que 35 ans.</p>
    </div>
    </div>

<!-- BLOC ACCES -->
<div data-aos="fade-down">
    <h2>Plan d'acces a <span class="andrew-ryan">Rapture</span></h2>
</div>

<div class="Bloc-Accès" data-aos="fade-down">
    <div class="bloc-img-map"><img src="assets/img/Site/map.jpg" alt="" class="img-map"></div>
    <div class="description-acces">
        <p class="text-titre-acces">Plan d'acces</p>
        <p class="text-acces">Le principal mode d'accès de Rapture est le <span class="span-ryan">phare</span>, situé à 63° 2' N, 29° 55' W, à environ <span class="span-ryan">433 kilomètres à l'ouest de Reykjavik</span>, la capitale de l'Islande. L'accès se fera grâce <span class="span-ryan">aux bathysphères</span> qui descendront le long du phare jusqu'à Rapture.</p>
        <p class="text-acces">Arrivé à Rapture, le moyen de transport est assuré par <span class="span-ryan">Rapture Metro</span> et <span class="span-ryan">Atlantic Express</span>, composés de bathyspères et de tramways. Le centre d'accueil se trouve aux côtés du <span class="span-ryan">restaurant Kashmir</span>, vous y trouverez également un centre d'informations afin de répondre à toutes vos questions.</p>
        <img src="assets/img/Site/warning.png" alt="warning" class="warning">
        <p class="text-acces-warning">Nous vous rappelons que toute <span class="span-ryan">tentative d'intrusion illégale</span>, c'est-à-dire, sans invitation officielle d'Andrew Ryan, sera passible de <span class="span-ryan">très lourdes conséquences...<span class="span-ryan"></p>
    </div>
</div>


<!-- BLOC ENSEIGNES -->
<div data-aos="fade-down">
    <h2>Enseignes a <span class="andrew-ryan">Rapture</span></h2>
</div>

<div data-aos="fade-down" class="carousel">
    <?php require_once('assets/template/carrousel.php'); ?>
</div>


<div class="Bloc-Enseignes" data-aos="fade-down">
    <div class="enseignes">
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/arcadia.png" alt="" class="enseigne-flick">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/bains-adonis.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/dionysus-park.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/farmer-s-market.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/fontaine.png" alt="" class="enseigne-flick1">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/fort-frolic.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/hephaestus.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/kashmir-restaurant.png" alt="" class="enseigne-flick">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/lighthouse.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/mercury-suites.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/neptune-s-bounty.png" alt="" class="enseigne-flick1">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/pauper-s-drop.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/pavillon-medical.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/ryan-amusement.png" alt="" class="enseigne">
        </div>
        <div class="imgs-enseignes">
        <img src="assets/img/Site/Enseignes/siren-alley.png" alt="" class="enseigne">
        </div>
    </div>
</div>

</section>

</main>

</body>

<script src="assets/js/home-play-audio.js"></script>
<script src="assets/js/home.js"></script>

<!-- AOS ANIMATION  -->

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>