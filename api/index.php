<?php
header('Cache-Control: no-cache, must-revalidate');
// ?page=modules => page dyal les modules, sinon l'page principale
$page = in_array($_GET['page'] ?? '', ['modules', 'agile'], true) ? $_GET['page'] : 'home'; // bach dima yban l'version jdida
$view = in_array($_GET['view'] ?? '', ['cours', 'tp'], true) ? $_GET['view'] : '';   // ?page=agile&view=tp => galerie dyal TP
// ====== MODIFIE GHIR HNA ======
$name     = "Chaimae Salah";
// t("francais", "english") : kaykteb nefss l'texte b joj loghat. L'site kaybdl bin FR w EN.
function t($fr, $en = null){
  $en = $en ?? $fr;
  return '<span data-fr="'.htmlspecialchars($fr, ENT_QUOTES, 'UTF-8').'" data-en="'.htmlspecialchars($en, ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($fr, ENT_QUOTES, 'UTF-8').'</span>';
}
// ph("francais", "english") : nefss l'haja l placeholder dyal l'inputs
function ph($fr, $en){
  $f = htmlspecialchars($fr, ENT_QUOTES, 'UTF-8'); $n = htmlspecialchars($en, ENT_QUOTES, 'UTF-8');
  return 'placeholder="'.$f.'" data-ph-fr="'.$f.'" data-ph-en="'.$n.'"';
}

$role     = t("Développeuse Full Stack", "Full Stack Developer");
$school   = "ISTA NTIC Tanger";   // smiya dyal l'madrasa (b7al b7al f joj loghat)
$email    = "chaimae@email.com";
$github   = "https://github.com/ton-username";
$linkedin = "https://linkedin.com/in/ton-username";
$cv       = "/docs/cv.pdf";           // 7et CV f public/docs/
$photo    = "/imges/photo.jpg";       // 7et tswira f public/imges/ (optionnel)

$about = t(
  "Étudiante en 2ème année Développement Digital option Full Stack à l'ISTA NTIC Tanger. Je construis des applications web complètes, de l'interface jusqu'à la base de données, avec un souci du détail.",
  "Second-year Digital Development student, Full Stack option, at ISTA NTIC Tangier. I build complete web applications, from the interface to the database, with attention to detail."
);

$instagram = "https://instagram.com/ton-username";

// smiya => pourcentage (kun sadqa f l'arqam)
$skills = [
  "HTML / CSS"   => 90,
  "JavaScript"   => 80,
  "PHP / MySQL"  => 75,
  "UI / UX Design" => 70,
];

// Les modules li kat9ra (bdl smiyat w descriptions b rassek)
$modules = [
  ["code" => "M201", "hours" => 60,  "name" => t("Préparation d'un projet web", "Preparing a web project")],
  ["code" => "M202", "hours" => 120, "name" => t("Approche agile", "Agile approach"), "page" => "agile"],   // "page" => l'lien l page dyalo
  ["code" => "M203", "hours" => 90,  "name" => t("Gestion des données", "Data management")],
  ["code" => "M204", "hours" => 90,  "name" => t("Développement front-end", "Front-end development")],
  ["code" => "M205", "hours" => 120, "name" => t("Développement back-end", "Back-end development")],
  ["code" => "M206", "hours" => 90,  "name" => t("Création d'une application Cloud native", "Building a cloud-native application")],
  ["code" => "M207", "hours" => 60,  "name" => t("Projet de synthèse", "Capstone project")],
];

// Page "Approche agile": tswar dyal l'cours w l'TP
// 7ett tswar f: public/imges/agile/cours/  w  public/imges/agile/tp/
// L'site kay9ra l'tswar b rasso. Ila ma khdamch, ktbi smiyatthom hna, mital: ["tp1.png", "tp2.png"]
$agile = [
  "cours" => [],
  "tp"    => [],
];

// Les langues: level = men 1 l 5 (bdlo b rassek ila t7assnti)
$languages = [
  ["name" => t("Arabe", "Arabic"),    "native" => "العربية", "lang" => "ar", "status" => t("Langue maternelle", "Native language"),          "level" => 5],
  ["name" => t("Français", "French"), "native" => "Français", "lang" => "fr", "status" => t("En cours d'apprentissage", "Currently learning"), "level" => 3],
  ["name" => t("Anglais", "English"), "native" => "English",  "lang" => "en", "status" => t("En cours d'apprentissage", "Currently learning"), "level" => 3],
];

$parcours = [
  ["2024 – 2026", t("Développement Digital, option Full Stack", "Digital Development, Full Stack option"), t($school)],
  ["2025", t("Stage", "Internship"), t("Ajoute ton stage ici", "Add your internship here")],
];
function agile_imgs($k){
  global $agile;
  $found = glob(__DIR__ . '/../public/imges/agile/' . $k . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
  if ($found) { sort($found); return array_map('basename', $found); }
  return $agile[$k];
}
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
try{var t=localStorage.getItem('theme');if(t)document.documentElement.setAttribute('data-theme',t)}catch(e){}
try{var l=localStorage.getItem('lang');if(l==='en'||l==='fr')document.documentElement.lang=l}catch(e){}
// setLang('fr') wla setLang('en') : kaybdl koll l'texte f l'page
function setLang(l){
  document.documentElement.lang=l;
  document.querySelectorAll('[data-fr]').forEach(function(el){el.textContent=el.dataset[l]});
  document.querySelectorAll('[data-ph-fr]').forEach(function(el){el.placeholder=l==='en'?el.dataset.phEn:el.dataset.phFr});
}
function toggleLang(){
  var n=document.documentElement.lang==='en'?'fr':'en';
  setLang(n);
  try{localStorage.setItem('lang',n)}catch(e){}
}
function toggleTheme(){
  var root=document.documentElement,dark=root.getAttribute('data-theme')==='dark';
  if(dark)root.removeAttribute('data-theme');else root.setAttribute('data-theme','dark');
  try{dark?localStorage.removeItem('theme'):localStorage.setItem('theme','dark')}catch(e){}
}
</script>
<title><?= e($name) ?> | Portfolio</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;800&family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
<style>
:root{
  --pink:#e5457f; --pink-d:#c42e68; --pink-l:#fde3ee;
  --bg:#f4f4f6; --card:#ffffff; --ink:#2b2b33; --muted:#6f6f7a;
  --shadow:0 8px 24px rgba(229,69,127,.12); --shadow-h:0 16px 40px rgba(229,69,127,.28);
  --hover:#c42e68; --nav:rgba(244,244,246,.85); --track:#e4e4ea; --line:#dcdce3; --ph:#9a9aa5; --thumb2:#e4e4ea;
}
/* THEME NOIR + PINK */
[data-theme="dark"]{
  --pink-d:#ff7fae; --pink-l:rgba(229,69,127,.18);
  --bg:#000; --card:#121212; --ink:#f6e9ef; --muted:#a79ba1;
  --shadow:0 8px 24px rgba(229,69,127,.18); --shadow-h:0 0 34px rgba(229,69,127,.45);
  --hover:#ff5c96; --nav:rgba(0,0,0,.8); --track:#1a1a1a; --line:#262626; --ph:#7d7378; --thumb2:#1a1a1a;
}
body,nav,.card,.cf input,.cf textarea{transition:background-color .4s,color .4s,border-color .4s,box-shadow .3s}
.navr{display:flex;align-items:center;gap:22px;min-width:0}
.tg{flex-shrink:0;width:44px;height:44px;border-radius:50%;border:0;cursor:pointer;background:var(--card);box-shadow:var(--shadow);font-size:1.3rem;line-height:1;display:grid;place-items:center;transition:transform .35s,box-shadow .3s,background-color .4s}
.tg:hover{transform:rotate(25deg) scale(1.1);box-shadow:var(--shadow-h)}
.tg:active{transform:scale(.92)}
.lg{flex-shrink:0;height:44px;padding:0 14px;border-radius:50px;border:0;cursor:pointer;background:var(--card);box-shadow:var(--shadow);font:700 .85rem 'Nunito',sans-serif;color:var(--muted);transition:transform .3s,box-shadow .3s,background-color .4s}
.lg:hover{transform:translateY(-3px);box-shadow:var(--shadow-h)}
html[lang="fr"] .l-fr,html[lang="en"] .l-en{color:var(--pink)}
.lang-card .native{font-family:'Fraunces',serif;font-size:1.7rem;color:var(--pink);margin-bottom:4px}
.lang-card h3{font-size:1.1rem}
.dots{margin-top:14px}
.dots span{display:inline-block;width:13px;height:13px;border-radius:50%;background:var(--track);margin-right:7px;transform:scale(0);transition:transform .4s cubic-bezier(.3,1.6,.5,1)}
.dots span.on{background:var(--pink);box-shadow:0 0 8px rgba(229,69,127,.5)}
.show .dots span{transform:scale(1)}
.dots span:nth-child(2){transition-delay:.1s}.dots span:nth-child(3){transition-delay:.2s}.dots span:nth-child(4){transition-delay:.3s}.dots span:nth-child(5){transition-delay:.4s}
.teaser{max-width:640px;margin:0 auto;text-align:center;padding:46px 30px}
.teaser h3{font-size:1.8rem;margin-bottom:12px}
.teaser .btn{margin-top:8px}
.badge{width:44px;height:44px;border-radius:50%;background:var(--pink-l);color:var(--pink-d);display:grid;place-items:center;font-weight:800;margin-bottom:14px;transition:background .3s,color .3s,transform .3s}
.card:hover .badge{background:var(--pink);color:#fff;transform:rotate(-8deg) scale(1.08)}
.back{display:inline-block;margin-bottom:26px;font-weight:700;color:var(--pink);transition:transform .25s}
.back:hover{transform:translateX(-6px)}
.badge{width:auto;height:auto;display:inline-block;padding:6px 16px;border-radius:30px}
.grid2{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:26px}
.rows a{display:flex;justify-content:space-between;gap:12px;padding:13px 4px;border-bottom:1px solid var(--line);transition:color .25s,padding-left .25s}
.rows a:last-child{border-bottom:0}
.rows a:hover{color:var(--pink);padding-left:12px}
.rows a::after{content:"\2192";color:var(--pink)}
.big{text-align:center;padding:38px 28px}
.ico{width:96px;height:96px;border-radius:28px;margin:0 auto 20px;display:grid;place-items:center;color:var(--pink);background:linear-gradient(135deg,var(--pink-l),transparent);box-shadow:inset 0 0 0 2px var(--pink-l);transition:transform .45s,background-color .3s}
.ico svg{width:46px;height:46px}
.card:hover .ico{transform:rotate(-6deg) scale(1.1)}
.big h3{font-size:1.6rem}
.big .btn{margin-top:6px}
.gal{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:22px}
.gal figure{border-radius:18px;overflow:hidden;background:var(--card);box-shadow:var(--shadow);cursor:zoom-in;transition:transform .3s,box-shadow .3s}
.gal figure:hover{transform:translateY(-6px);box-shadow:var(--shadow-h)}
.gal img{width:100%;display:block;aspect-ratio:4/3;object-fit:cover;transition:transform .5s}
.gal figure:hover img{transform:scale(1.06)}
.gal figcaption{padding:12px 16px;font-weight:700}
#lb{position:fixed;inset:0;background:rgba(0,0,0,.88);display:none;place-items:center;z-index:50;cursor:zoom-out;padding:20px}
#lb.on{display:grid}
#lb img{max-width:100%;max-height:100%;border-radius:12px}
.ic-sun{display:none}
[data-theme="dark"] .ic-moon{display:none}
[data-theme="dark"] .ic-sun{display:inline}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--ink);line-height:1.65}
h1,h2,h3{font-family:'Fraunces',serif;line-height:1.15}
a{color:inherit;text-decoration:none}
.wrap{max-width:1040px;margin:0 auto;padding:0 22px}
section{padding:80px 0}
h2{font-size:2rem;margin-bottom:34px;position:relative;display:inline-block}
h2::after{content:"";position:absolute;left:0;bottom:-8px;width:56px;height:5px;border-radius:5px;background:var(--pink);transition:width .4s}
h2:hover::after{width:100%}

/* NAV */
nav{position:sticky;top:0;z-index:10;background:var(--nav);backdrop-filter:blur(10px);box-shadow:0 2px 14px rgba(0,0,0,.06)}
nav .wrap{display:flex;justify-content:space-between;align-items:center;height:64px}
.logo{font-family:'Fraunces',serif;font-weight:800;font-size:1.25rem;color:var(--pink)}
nav ul{display:flex;gap:26px;list-style:none}
nav ul a{font-weight:700;position:relative;padding:4px 0;transition:color .25s}
nav ul a::after{content:"";position:absolute;left:0;bottom:0;height:2px;width:0;background:var(--pink);transition:width .3s}
nav ul a:hover{color:var(--pink)} nav ul a:hover::after{width:100%}

/* HERO (animation f chargement, ghir hna) */
.hero{min-height:88vh;display:flex;align-items:center;position:relative;overflow:hidden}
.hero .wrap{display:grid;grid-template-columns:1.2fr .8fr;gap:40px;align-items:center}
.hero h1{font-size:clamp(2.4rem,6vw,4rem);font-weight:800}
.hero h1 span{color:var(--pink)}
.hero p.sub{margin:18px 0 30px;color:var(--muted);font-size:1.1rem;max-width:480px}
.btns{display:flex;gap:14px;flex-wrap:wrap}
.btn{padding:13px 28px;border-radius:50px;font-weight:700;transition:transform .25s,box-shadow .25s,background .25s;display:inline-block}
.btn.primary{background:var(--pink);color:#fff;box-shadow:var(--shadow)}
.btn.primary:hover{background:var(--hover);transform:translateY(-4px);box-shadow:var(--shadow-h)}
.btn.ghost{border:2px solid var(--pink);color:var(--pink)}
.btn.ghost:hover{background:var(--pink);color:#fff;transform:translateY(-4px);box-shadow:var(--shadow-h)}
.avatar{justify-self:center;width:min(300px,70vw);aspect-ratio:1;border-radius:50% 45% 55% 50%;background:linear-gradient(135deg,var(--pink),#f7a8c6);box-shadow:var(--shadow-h);display:grid;place-items:center;overflow:hidden;animation:morph 9s ease-in-out infinite,float 5s ease-in-out infinite}
.avatar img{width:100%;height:100%;object-fit:cover}
.avatar b{font-family:'Fraunces',serif;font-size:5rem;color:#fff}
@keyframes morph{50%{border-radius:45% 55% 45% 55%}}
@keyframes float{50%{transform:translateY(-14px)}}
.hero .wrap>div:first-child>*{opacity:0;transform:translateY(22px);animation:in .7s forwards}
.hero .wrap>div:first-child>*:nth-child(2){animation-delay:.15s}
.hero .wrap>div:first-child>*:nth-child(3){animation-delay:.3s}
.hero .wrap>div:first-child>*:nth-child(4){animation-delay:.45s}
@keyframes in{to{opacity:1;transform:none}}

/* CARDS */
.card{background:var(--card);border-radius:18px;padding:26px;box-shadow:var(--shadow);transition:transform .3s,box-shadow .3s}
.card:hover{transform:translateY(-8px);box-shadow:var(--shadow-h)}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px}
.tag{display:inline-block;background:var(--pink-l);color:var(--pink-d);padding:4px 13px;border-radius:30px;font-size:.85rem;font-weight:700;margin:4px 6px 0 0;transition:background .25s,color .25s,transform .25s}
.tag:hover{background:var(--pink);color:#fff;transform:scale(1.08)}
.card h3{margin-bottom:10px}
.card p{color:var(--muted);margin-bottom:12px}
.links{margin-top:16px;display:flex;gap:18px;font-weight:700;color:var(--pink)}
.links a{transition:letter-spacing .25s}
.links a:hover{letter-spacing:.06em;color:var(--pink-d)}
.proj .thumb{height:140px;border-radius:12px;margin-bottom:18px;background:linear-gradient(135deg,var(--pink-l),var(--thumb2));display:grid;place-items:center;font-family:'Fraunces',serif;font-size:2.4rem;color:var(--pink);transition:transform .4s}
.proj:hover .thumb{transform:scale(1.04)}

/* TIMELINE */
.tl{border-left:3px solid var(--pink-l);padding-left:26px}
.tl .item{position:relative;margin-bottom:26px}
.tl .item::before{content:"";position:absolute;left:-35px;top:6px;width:16px;height:16px;border-radius:50%;background:var(--pink);box-shadow:0 0 0 5px var(--pink-l);transition:transform .3s}
.tl .item:hover::before{transform:scale(1.4)}
.tl small{color:var(--pink-d);font-weight:700}

/* CONTACT */
/* SKILLS + CONTACT (nefss alwan: pink + gris fatih) */
.dark h2{display:block;text-align:center}
.dark h2::after,.dark h2:hover::after{left:50%;transform:translateX(-50%);width:80px;height:4px;background:var(--pink);box-shadow:0 0 12px rgba(229,69,127,.45)}
.bar{margin-bottom:30px}
.bar .top{display:flex;justify-content:space-between;margin-bottom:8px;font-weight:700}
.track{height:14px;background:var(--track);border-radius:20px;overflow:hidden}
.fill{height:100%;width:0;border-radius:20px;background:linear-gradient(90deg,#f08bb1,var(--pink));box-shadow:0 0 14px rgba(229,69,127,.45);transition:width 1.4s cubic-bezier(.2,.8,.2,1)}
.show .fill{width:var(--w)}
form.cf{max-width:560px;margin:0 auto;display:grid;gap:18px}
.cf input,.cf textarea{width:100%;background:var(--card);border:1px solid var(--line);border-radius:16px;padding:16px 20px;color:var(--ink);font:inherit;box-shadow:var(--shadow);transition:border-color .25s,box-shadow .25s}
.cf textarea{min-height:140px;resize:vertical}
.cf input::placeholder,.cf textarea::placeholder{color:var(--ph)}
.cf input:focus,.cf textarea:focus{outline:none;border-color:var(--pink);box-shadow:0 0 0 3px rgba(229,69,127,.2)}
.cf button{border:0;cursor:pointer;background:var(--pink);color:#fff;font:700 1rem 'Nunito',sans-serif;padding:15px;border-radius:50px;box-shadow:var(--shadow);transition:transform .25s,box-shadow .25s,background .25s}
.cf button:hover{background:var(--hover);transform:translateY(-4px);box-shadow:var(--shadow-h)}
footer.dark{border-top:1px solid var(--line);padding:34px 22px;display:flex;justify-content:center;gap:14px;flex-wrap:wrap}
footer.dark a{border:2px solid var(--pink);color:var(--pink);font-weight:700;padding:9px 26px;border-radius:50px;transition:background .25s,color .25s,box-shadow .25s,transform .25s}
footer.dark a:hover{background:var(--pink);color:#fff;box-shadow:var(--shadow-h);transform:translateY(-4px)}

/* Reveal au scroll */
.rv{opacity:0;transform:translateY(30px);transition:opacity .7s,transform .7s}
.rv.show{opacity:1;transform:none}

:focus-visible{outline:3px solid var(--pink);outline-offset:3px}
@media(max-width:760px){
  .hero .wrap{grid-template-columns:1fr;text-align:center}
  .hero p.sub{margin-inline:auto}.btns{justify-content:center}
  .avatar{order:-1;width:200px}
  nav .wrap{gap:12px}
  .navr{gap:10px}
  nav ul{gap:14px;font-size:.85rem;overflow-x:auto;white-space:nowrap;min-width:0;scrollbar-width:none}
  .logo{display:none}
}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}.rv,.hero .wrap>div:first-child>*{opacity:1;transform:none}}
</style>
</head>
<body>

<nav><div class="wrap">
  <a href="/" class="logo"><?= e($name) ?></a>
  <div class="navr">
  <ul>
    <li><a href="/#apropos"><?= t('À propos', 'About') ?></a></li>
    <li><a href="/#skills"><?= t('Compétences', 'Skills') ?></a></li>
    <li><a href="/#langues"><?= t('Langues', 'Languages') ?></a></li>
    <li><a href="/#parcours"><?= t('Parcours', 'Education') ?></a></li>
    <li><a href="/#modules"><?= t('Modules') ?></a></li>
    <li><a href="/#contact"><?= t('Contact') ?></a></li>
  </ul>
  <button class="lg" type="button" onclick="toggleLang()" aria-label="Français / English" title="Français / English"><span class="l-fr">FR</span> | <span class="l-en">EN</span></button>
  <button class="tg" type="button" onclick="toggleTheme()" aria-label="Changer les couleurs du site (noir / pink)" title="Noir / Pink"><span class="ic-moon">&#127769;</span><span class="ic-sun">&#9728;&#65039;</span></button>
  </div>
</div></nav>

<?php if ($page === 'modules'): ?>
<!-- ===== PAGE MODULES ===== -->
<section style="padding-top:50px"><div class="wrap rv">
  <a class="back" href="/#modules">&larr; <?= t('Retour', 'Back') ?></a><br>
  <h2><?= t('Mes modules', 'My modules') ?></h2>
  <p style="color:var(--muted);margin-bottom:30px"><?= t("Les modules que j'étudie en Développement Digital, option Full Stack.", "The modules I study in Digital Development, Full Stack option.") ?></p>
  <div class="grid">
    <?php foreach ($modules as $m): ?>
      <article class="card">
        <div class="badge"><?= e($m['code']) ?></div>
        <h3><?= $m['name'] ?></h3>
        <span class="tag"><?= (int)$m['hours'] ?> h</span>
        <?php if (!empty($m['page'])): ?>
          <div class="links"><a href="/?page=<?= e($m['page']) ?>"><?= t('Voir le module', 'View module') ?></a></div>
        <?php endif; ?>
      </article>
    <?php endforeach; ?>
  </div>
</div></section>

<?php elseif ($page === 'agile' && $view): ?>
<!-- ===== GALERIE : COURS ou TP (tswar) ===== -->
<?php $imgs = agile_imgs($view); $isTp = ($view === 'tp'); ?>
<section style="padding-top:50px"><div class="wrap rv">
  <a class="back" href="/?page=agile">&larr; <?= t('Retour', 'Back') ?></a><br>
  <h2><?= $isTp ? t('TP', 'Labs (TP)') : t('Cours', 'Lessons') ?> &middot; <?= t('Approche agile', 'Agile approach') ?></h2>
  <?php if ($imgs): ?>
    <div class="gal">
      <?php foreach ($imgs as $i => $f): ?>
        <figure>
          <img src="/imges/agile/<?= e($view) ?>/<?= e(rawurlencode($f)) ?>" alt="<?= $isTp ? 'TP' : 'Cours' ?> <?= $i + 1 ?>" loading="lazy">
          <figcaption><?= $isTp ? 'TP' : 'Cours' ?> <?= $i + 1 ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="card"><p style="margin:0"><?= t("Pas encore d'images. Ajoute-les dans public/imges/agile/$view/", "No images yet. Add them in public/imges/agile/$view/") ?></p></div>
  <?php endif; ?>
</div></section>
<div id="lb"><img alt=""></div>

<?php elseif ($page === 'agile'): ?>
<!-- ===== PAGE APPROCHE AGILE (M202) ===== -->
<section style="padding-top:50px"><div class="wrap rv">
  <a class="back" href="/?page=modules">&larr; <?= t('Retour aux modules', 'Back to modules') ?></a><br>
  <h2><?= t('Approche agile', 'Agile approach') ?></h2>
  <p style="color:var(--muted);margin-bottom:30px">M202 &middot; 120 h</p>
  <div class="grid2">
    <?php
    $cards = [
      ['cours', t('Cours', 'Lessons'), t('Les supports de cours du module.', 'The course materials of the module.'), t('Voir le cours', 'View lessons')],
      ['tp',    t('TP', 'Labs (TP)'),  t('Les travaux pratiques, en images.', 'The practical work, as images.'),    t('Voir le TP', 'View labs')],
    ];
    foreach ($cards as $c): $n = count(agile_imgs($c[0])); ?>
      <div class="card big">
        <div class="ico">
          <?php if ($c[0] === 'cours'): ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5z"/><path d="M4 19V5.5"/><path d="M9 7h7M9 11h5"/></svg>
          <?php else: ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="12" rx="2"/><path d="M2 20h20"/><path d="M10 8.5 8 10.5l2 2M14 8.5l2 2-2 2"/></svg>
          <?php endif; ?>
        </div>
        <h3><?= $c[1] ?></h3>
        <p><?= $c[2] ?></p>
        <?php if ($n): ?><span class="tag"><?= $n ?> images</span><br><?php endif; ?>
        <a class="btn primary" href="/?page=agile&amp;view=<?= e($c[0]) ?>"><?= $c[3] ?></a>
      </div>
    <?php endforeach; ?>
  </div>
</div></section>

<?php else: ?>
<!-- ===== PAGE PRINCIPALE ===== -->

<header class="hero" id="top"><div class="wrap">
  <div>
    <p style="color:var(--pink-d);font-weight:700"><?= t('Salut, je suis', "Hi, I'm") ?></p>
    <h1><?= e($name) ?><br><span><?= $role ?></span></h1>
    <p class="sub"><?= t("Étudiante à $school. Je crée des sites et applications web complets, du design à la base de données.", "Student at $school. I build complete websites and web apps, from design to database.") ?></p>
    <div class="btns">
      <a class="btn primary" href="#modules"><?= t('Voir mes modules', 'View my modules') ?></a>
      <a class="btn ghost" href="<?= e($cv) ?>" download><?= t('Télécharger mon CV', 'Download my CV') ?></a>
    </div>
  </div>
  <div class="avatar">
    <?php if (file_exists(__DIR__ . '/../public' . $photo)): ?>
      <img src="<?= e($photo) ?>" alt="<?= e($name) ?>">
    <?php else: ?>
      <b><?= e(mb_substr($name, 0, 1)) ?></b>
    <?php endif; ?>
  </div>
</div></header>

<section id="apropos"><div class="wrap rv">
  <h2><?= t('À propos', 'About') ?></h2>
  <div class="card"><p style="margin:0;font-size:1.05rem;color:var(--ink)"><?= $about ?></p></div>
</div></section>

<section id="skills" class="dark"><div class="wrap rv">
  <h2><?= t('Compétences', 'Skills') ?></h2>
  <?php foreach ($skills as $label => $pct): ?>
    <div class="bar">
      <div class="top"><span><?= e($label) ?></span><span><?= (int)$pct ?>%</span></div>
      <div class="track"><div class="fill" style="--w:<?= (int)$pct ?>%"></div></div>
    </div>
  <?php endforeach; ?>
</div></section>

<section id="langues"><div class="wrap rv">
  <h2><?= t('Langues', 'Languages') ?></h2>
  <div class="grid">
    <?php foreach ($languages as $l): ?>
      <div class="card lang-card">
        <div class="native" lang="<?= e($l['lang']) ?>"><?= e($l['native']) ?></div>
        <h3><?= $l['name'] ?></h3>
        <p style="margin:6px 0 0"><?= $l['status'] ?></p>
        <div class="dots">
          <?php for ($i = 1; $i <= 5; $i++): ?><span class="<?= $i <= $l['level'] ? 'on' : '' ?>"></span><?php endfor; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div></section>

<section id="parcours"><div class="wrap rv">
  <h2><?= t('Parcours', 'Education') ?></h2>
  <div class="tl">
    <?php foreach ($parcours as $x): ?>
      <div class="item"><small><?= e($x[0]) ?></small><h3><?= $x[1] ?></h3><p style="color:var(--muted)"><?= $x[2] ?></p></div>
    <?php endforeach; ?>
  </div>
</div></section>

<section id="modules"><div class="wrap rv">
  <div class="card teaser">
    <h3><?= t('Mes modules', 'My modules') ?></h3>
    <p><?= t("Découvre les modules que j'étudie en Développement Digital, option Full Stack.", "Discover the modules I study in Digital Development, Full Stack option.") ?></p>
    <a class="btn primary" href="/?page=modules"><?= t('Voir les modules', 'View modules') ?></a>
  </div>
</div></section>

<section id="contact" class="dark"><div class="wrap rv">
  <h2><?= t('Contact') ?></h2>
  <form class="cf" id="cf">
    <input type="text" id="cn" <?= ph('Votre nom', 'Your name') ?> required>
    <input type="email" id="ce" <?= ph('Votre email', 'Your email') ?> required>
    <textarea id="cm" <?= ph('Votre message', 'Your message') ?> required></textarea>
    <button type="submit"><?= t('Envoyer le message', 'Send message') ?></button>
  </form>
</div></section>

<?php endif; ?>

<footer class="dark">
  <a href="<?= e($github) ?>" target="_blank" rel="noopener">GitHub</a>
  <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener">LinkedIn</a>
  <a href="<?= e($instagram) ?>" target="_blank" rel="noopener">Instagram</a>
</footer>

<script>
// Kayft'7 l'email app b message m3emmer (bla backend)
var cfEl=document.getElementById('cf');
if(cfEl)cfEl.addEventListener('submit',function(ev){
  ev.preventDefault();
  const n=document.getElementById('cn').value,m=document.getElementById('ce').value,t=document.getElementById('cm').value;
  location.href='mailto:<?= e($email) ?>?subject='+encodeURIComponent((document.documentElement.lang==='en'?'Message from ':'Message de ')+n)+'&body='+encodeURIComponent(t+'\n\n'+n+' ('+m+')');
});
const io=new IntersectionObserver(es=>es.forEach(x=>{if(x.isIntersecting){x.target.classList.add('show');io.unobserve(x.target)}}),{threshold:.12});
document.querySelectorAll('.rv').forEach(el=>io.observe(el));
var lb=document.getElementById('lb');
if(lb){
  document.querySelectorAll('.gal img').forEach(function(im){im.addEventListener('click',function(){lb.querySelector('img').src=im.src;lb.classList.add('on')})});
  lb.addEventListener('click',function(){lb.classList.remove('on')});
}
setLang(document.documentElement.lang); // applique la langue sauvegardée
</script>
</body>
</html>