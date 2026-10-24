<?php
header('Cache-Control: no-cache, must-revalidate');
// ?page=modules => page dyal les modules, ?page=projets => page dyal les projets, sinon l'page principale
$page = in_array($_GET['page'] ?? '', ['modules', 'agile', 'projets', 'projet'], true) ? $_GET['page'] : 'home'; // bach dima yban l'version jdida
$view = in_array($_GET['view'] ?? '', ['cours', 'tp'], true) ? $_GET['view'] : '';   // ?page=agile&view=tp => les 6 ateliers
$atelier = (int)($_GET['atelier'] ?? 0);   // ?page=agile&view=tp&atelier=3 => galerie dyal Atelier 3
if ($atelier < 1 || $atelier > 6) $atelier = 0;
$pslug = preg_replace('/[^a-z0-9_-]/i', '', $_GET['p'] ?? '');   // ?page=projet&p=vendo => page dyal projet
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

// Les projets (bdl smiyat w descriptions w liens b rassek)
// "slug"  => smiya f l'lien (?page=projet&p=vendo)
// "img"   => tswira (f public/imges/)
// "parts" => les cartes li kaybano f page dyal projet (01, 02, 03...)
//            "links" => [ [smiya, lien], [smiya, lien] ]  (khlliha [] => kayban "Support à ajouter")
$projects = [
  [
    "slug"  => "vendo",
    "name"  => "Vendo",
    "desc"  => t("Un projet qui rassemble trois composants : méthode en cascade, gestion agile et pratique Git.", "A project that brings together three components: waterfall method, agile management and Git practice."),
    "tags"  => ["HTML", "CSS", "PHP"],
    "img"   => "projets/vendo.jpeg",
    "parts" => [
      [
        "title" => t("Méthode en cascade", "Waterfall method"),
        "desc"  => t("Supports et étapes de l'atelier classique.", "Materials and steps of the classic workshop."),
        "links" => [
          [t("Ouvrir le PowerPoint", "Open the PowerPoint"), "/docs/vendo-cascade.pptx"],   // 7ett l'fichier f public/docs/
          [t("Ouvrir le PDF", "Open the PDF"),               "/docs/vendo-cascade.pdf"],
        ],
      ],
      [
        "title" => t("Gestion agile", "Agile management"),
        "desc"  => t("Organisation du projet, user stories et planification du sprint.", "Project organisation, user stories and sprint planning."),
        "links" => [
          [t("Consulter le support", "View the material"), "/docs/vendo-agile.pdf"],
        ],
      ],
      [
        "title" => t("Pratique Git", "Git practice"),
        "desc"  => t("Exercices et exemples liés à la gestion des versions.", "Exercises and examples about version control."),
        "links" => [],   // vide => kayban "Support à ajouter"
      ],
    ],
  ],
  ["slug" => "projet2", "name" => t("Projet 2", "Project 2"), "desc" => t("Description du projet.", "Project description."), "tags" => ["JavaScript"], "parts" => []],
];

// Page "Approche agile": tswar dyal l'cours w l'TP
// 7ett tswar f: public/imges/agile/cours/  w  public/imges/agile/tp/atelier1/ ... atelier6/
// L'site kay9ra l'tswar b rasso. Ila ma khdamch, ktbi smiyatthom hna, mital: "tp/atelier1" => ["a.png", "b.png"]
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
// kat9ra les tswar mn dossier ($k = "cours" wla "tp/atelier3" ...)
function agile_imgs($k){
  global $agile;
  $found = glob(__DIR__ . '/../public/imges/agile/' . $k . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE) ?: [];
  if ($found) { sort($found); return array_map('basename', $found); }
  return $agile[$k] ?? [];
}
// tswira dyal l'card (ila ma kaynach l'fichier, kat3ref icône)
function cover($file, $svg){
  $p = __DIR__ . '/../public/imges/' . $file;
  return '<div class="cover">' . (file_exists($p) ? '<img src="/imges/' . e($file) . '" alt="" loading="lazy">' : $svg) . '</div>';
}
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
// 'js' => les animations GSAP sont actives (kat-t7yyed ila l'motion mdeyya9)
if(!(window.matchMedia&&matchMedia('(prefers-reduced-motion: reduce)').matches))document.documentElement.classList.add('js');
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
  --bg:#faf6f7; --card:#ffffff; --ink:#1d1a1c; --muted:#76707a;
  --shadow:0 1px 2px rgba(29,26,28,.04),0 12px 32px rgba(229,69,127,.08); --shadow-h:0 22px 50px rgba(229,69,127,.22);
  --hover:#c42e68; --nav:rgba(250,246,247,.78); --track:#ece6e9; --line:#eadfe4; --ph:#a79ca3; --thumb2:#f3eaee;
}
/* THEME NOIR + PINK */
[data-theme="dark"]{
  --pink-d:#ff7fae; --pink-l:rgba(229,69,127,.18);
  --bg:#000; --card:#111; --ink:#f6e9ef; --muted:#a79ba1;
  --shadow:0 8px 24px rgba(229,69,127,.14); --shadow-h:0 0 40px rgba(229,69,127,.4);
  --hover:#ff5c96; --nav:rgba(0,0,0,.72); --track:#1c1c1c; --line:#262626; --ph:#7d7378; --thumb2:#1a1a1a;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
/* Lenis (smooth scroll) */
html.lenis,html.lenis body{height:auto}
.lenis.lenis-smooth{scroll-behavior:auto!important}
.lenis.lenis-stopped{overflow:hidden}
body{font-family:'Nunito',sans-serif;background:var(--bg);color:var(--ink);line-height:1.65;overflow-x:hidden;transition:background-color .4s,color .4s}
h1,h2,h3{font-family:'Fraunces',serif;line-height:1.1;letter-spacing:-.015em}
a{color:inherit;text-decoration:none}
.wrap{max-width:1080px;margin:0 auto;padding:0 24px}
section{padding:96px 0}
section.dark{background:var(--card);border-block:1px solid var(--line)}
h2{font-size:clamp(2rem,4.6vw,3.2rem);margin-bottom:44px;position:relative;display:inline-block}
h2::after{content:"";position:absolute;left:0;bottom:-10px;width:56px;height:4px;border-radius:4px;background:var(--pink);transition:width .5s cubic-bezier(.2,.8,.2,1)}
h2:hover::after{width:100%}

/* ===== TRANSITION DE PAGE (GSAP) ===== */
#pt{position:fixed;inset:0;background:var(--pink);z-index:100;pointer-events:none;transform:scaleY(0);transform-origin:top}
.js #pt{transform:scaleY(1)}

/* ===== NAV ===== */
nav{position:sticky;top:0;z-index:20;background:var(--nav);backdrop-filter:blur(14px);border-bottom:1px solid var(--line)}
nav .wrap{display:flex;justify-content:space-between;align-items:center;height:68px}
.logo{font-family:'Fraunces',serif;font-weight:800;font-size:1.3rem;color:var(--ink)}
.logo::after{content:".";color:var(--pink)}
nav ul{display:flex;gap:28px;list-style:none}
nav ul a{font-weight:700;font-size:.95rem;position:relative;padding:4px 0;color:var(--muted);transition:color .25s}
nav ul a::after{content:"";position:absolute;left:0;bottom:0;height:2px;width:0;background:var(--pink);transition:width .35s cubic-bezier(.2,.8,.2,1)}
nav ul a:hover{color:var(--ink)} nav ul a:hover::after{width:100%}
.navr{display:flex;align-items:center;gap:22px;min-width:0}
.tg{flex-shrink:0;width:44px;height:44px;border-radius:50%;border:1px solid var(--line);cursor:pointer;background:var(--card);font-size:1.25rem;line-height:1;display:grid;place-items:center;transition:box-shadow .3s,background-color .4s}
.tg:hover{box-shadow:var(--shadow-h)}
.lg{flex-shrink:0;height:44px;padding:0 14px;border-radius:50px;border:1px solid var(--line);cursor:pointer;background:var(--card);font:700 .85rem 'Nunito',sans-serif;color:var(--muted);transition:box-shadow .3s,background-color .4s}
.lg:hover{box-shadow:var(--shadow-h)}
html[lang="fr"] .l-fr,html[lang="en"] .l-en{color:var(--pink)}
.ic-sun{display:none}
[data-theme="dark"] .ic-moon{display:none}
[data-theme="dark"] .ic-sun{display:inline}

/* ===== BOUTONS (remplissage rose au survol) ===== */
.btns{display:flex;gap:14px;flex-wrap:wrap}
.btn{position:relative;overflow:hidden;isolation:isolate;padding:14px 30px;border-radius:50px;font-weight:700;display:inline-block;transition:color .35s,box-shadow .35s,border-color .35s}
.btn::before{content:"";position:absolute;inset:0;background:var(--pink);transform:translateY(101%);transition:transform .45s cubic-bezier(.2,.8,.2,1);z-index:-1}
.btn:hover::before{transform:none}
.btn.primary{background:var(--ink);color:var(--bg)}
.btn.primary:hover{color:#fff;box-shadow:var(--shadow-h)}
.btn.ghost{border:2px solid var(--ink);color:var(--ink)}
.btn.ghost:hover{color:#fff;border-color:var(--pink)}

/* ===== HERO ===== */
.hero{min-height:calc(100vh - 68px);display:flex;align-items:center;position:relative;overflow:hidden}
.blob{position:absolute;border-radius:50%;filter:blur(70px);pointer-events:none}
.b1{width:420px;height:420px;background:var(--pink);top:-120px;right:-80px;opacity:.4}
.b2{width:340px;height:340px;background:#f7a8c6;bottom:-140px;left:-100px;opacity:.35}
[data-theme="dark"] .blob{opacity:.25}
.hero .wrap{position:relative;z-index:1;display:grid;grid-template-columns:1.25fr .75fr;gap:40px;align-items:center}
.hg{color:var(--pink-d);font-weight:800;letter-spacing:.14em;text-transform:uppercase;font-size:.85rem;margin-bottom:18px}
.hero h1{font-size:clamp(2.8rem,6.4vw,5rem);font-weight:800}
.line{display:block;overflow:hidden;padding-bottom:.08em}
.inner{display:block}
.line.role{margin-top:12px}
.line.role .inner{font-family:'Nunito',sans-serif;font-weight:700;font-size:clamp(1.1rem,2.2vw,1.5rem);color:var(--pink);letter-spacing:0}
.hero p.sub{margin:22px 0 32px;color:var(--muted);font-size:1.1rem;max-width:480px}
.avatar{justify-self:center;width:min(300px,70vw);aspect-ratio:1;border-radius:50% 45% 55% 50%;background:linear-gradient(135deg,var(--pink),#f7a8c6);box-shadow:var(--shadow-h);display:grid;place-items:center;overflow:hidden;animation:morph 9s ease-in-out infinite}
.avatar img{width:100%;height:100%;object-fit:cover}
.avatar b{font-family:'Fraunces',serif;font-size:5rem;color:#fff}
@keyframes morph{50%{border-radius:45% 55% 45% 55%}}

/* ===== MARQUEE (defilement infini, GSAP) ===== */
.marquee{overflow:hidden;border-block:1px solid var(--line);padding:26px 0;background:var(--card)}
.mq-track{display:flex;width:max-content}
.mq-half{display:flex;align-items:center;gap:44px;padding-right:44px;white-space:nowrap;font-family:'Fraunces',serif;font-weight:800;font-size:clamp(1.6rem,4vw,2.6rem);color:transparent;-webkit-text-stroke:1.5px var(--ink)}
.mq-half i{font-style:normal;color:var(--pink);-webkit-text-stroke:0;font-size:.7em}

/* ===== CARDS ===== */
.card{background:var(--card);border:1px solid var(--line);border-radius:26px;padding:28px;box-shadow:var(--shadow);transition:transform .4s cubic-bezier(.2,.8,.2,1),box-shadow .4s,border-color .3s,background-color .4s}
.card:hover{transform:translateY(-8px);box-shadow:var(--shadow-h);border-color:var(--pink)}
.card h3{margin-bottom:10px}
.card p{color:var(--muted);margin-bottom:12px}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:24px}
.grid2{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:26px}
.tag{display:inline-block;background:var(--pink-l);color:var(--pink-d);padding:4px 13px;border-radius:30px;font-size:.85rem;font-weight:700;margin:4px 6px 0 0;transition:background .25s,color .25s}
.tag:hover{background:var(--pink);color:#fff}
.badge{display:inline-block;padding:6px 16px;border-radius:30px;margin-bottom:14px;background:var(--pink-l);color:var(--pink-d);font-weight:800;transition:background .3s,color .3s}
.card:hover .badge{background:var(--pink);color:#fff}
.links{margin-top:16px;display:flex;gap:18px;font-weight:700;color:var(--pink)}
.links a{transition:letter-spacing .25s}
.links a:hover{letter-spacing:.06em;color:var(--pink-d)}
.back{display:inline-block;margin-bottom:26px;font-weight:700;color:var(--pink);transition:transform .25s}
.back:hover{transform:translateX(-6px)}

/* langues */
.lang-card .native{font-family:'Fraunces',serif;font-size:1.8rem;color:var(--pink);margin-bottom:4px}
.lang-card h3{font-size:1.1rem}
.dots{margin-top:14px}
.dots span{display:inline-block;width:13px;height:13px;border-radius:50%;background:var(--track);margin-right:7px}
.dots span.on{background:var(--pink);box-shadow:0 0 8px rgba(229,69,127,.5)}

/* modules + projets (2 cartes) */
.teaser{max-width:640px;margin:0 auto;text-align:center;padding:40px 30px}
.teaser h3{font-size:1.8rem;margin-bottom:12px}
.teaser .btn{margin-top:8px}
.teasers{display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:26px}
.teasers .teaser{max-width:none;margin:0}
.cover{height:170px;border-radius:16px;margin-bottom:20px;overflow:hidden;display:grid;place-items:center;color:var(--pink);background:linear-gradient(135deg,var(--pink-l),var(--thumb2))}
.cover img{width:100%;height:100%;object-fit:cover;transition:transform .6s}
.cover svg{width:64px;height:64px}
.teaser:hover .cover img{transform:scale(1.06)}

/* cartes avec icone (agile, ateliers) */
.big{text-align:center;padding:38px 28px}
.ico{width:96px;height:96px;border-radius:28px;margin:0 auto 20px;display:grid;place-items:center;color:var(--pink);background:linear-gradient(135deg,var(--pink-l),transparent);box-shadow:inset 0 0 0 2px var(--pink-l);transition:transform .5s cubic-bezier(.2,.8,.2,1)}
.ico svg{width:46px;height:46px}
.card:hover .ico{transform:rotate(-6deg) scale(1.1)}
.big h3{font-size:1.6rem}
.big .btn{margin-top:6px}

/* galerie + lightbox */
.gal{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:22px}
.gal figure{border-radius:20px;overflow:hidden;background:var(--card);border:1px solid var(--line);box-shadow:var(--shadow);cursor:zoom-in;transition:transform .4s cubic-bezier(.2,.8,.2,1),box-shadow .3s}
.gal figure:hover{transform:translateY(-6px);box-shadow:var(--shadow-h)}
.gal img{width:100%;display:block;aspect-ratio:4/3;object-fit:cover;transition:transform .6s}
.gal figure:hover img{transform:scale(1.06)}
.gal figcaption{padding:12px 16px;font-weight:700}
#lb{position:fixed;inset:0;background:rgba(0,0,0,.88);display:none;place-items:center;z-index:50;cursor:zoom-out;padding:20px}
#lb.on{display:grid}
#lb img{max-width:100%;max-height:100%;border-radius:12px}

/* projets */
.proj .thumb{height:140px;border-radius:16px;margin-bottom:18px;background:linear-gradient(135deg,var(--pink-l),var(--thumb2));display:grid;place-items:center;font-family:'Fraunces',serif;font-size:2.4rem;color:var(--pink);transition:transform .5s}
.proj:hover .thumb{transform:scale(1.04)}
.proj .thumb.has-img{height:200px;overflow:hidden;padding:0}
.proj .thumb.has-img img{width:100%;height:100%;object-fit:cover}
/* page projet : carte principale + 3 cartes (01 / 02 / 03) */
.pj-wrap{padding:34px}
.pj-wrap:hover{transform:none;box-shadow:var(--shadow);border-color:var(--line)}
.pj-head{display:flex;align-items:center;gap:22px;flex-wrap:wrap}
.pj-head img{width:84px;height:84px;border-radius:22px;object-fit:cover;box-shadow:var(--shadow)}
.pj-sep{height:1px;background:var(--line);margin:28px 0}
.pj-parts{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px}
.part{border:1px solid var(--line);border-radius:20px;padding:24px;background:var(--bg);transition:transform .4s cubic-bezier(.2,.8,.2,1),box-shadow .3s,border-color .3s,background-color .4s}
.part:hover{transform:translateY(-6px);border-color:var(--pink);box-shadow:var(--shadow-h)}
.part h3{font-size:1.15rem}
.part p{color:var(--muted);margin-bottom:12px}
.part .links{flex-wrap:wrap;gap:6px 18px}
.part .soon{color:var(--muted);font-weight:700;font-size:.92rem}

/* TIMELINE */
.tl{border-left:3px solid var(--pink-l);padding-left:28px}
.tl .item{position:relative;margin-bottom:28px}
.tl .item::before{content:"";position:absolute;left:-37px;top:6px;width:16px;height:16px;border-radius:50%;background:var(--pink);box-shadow:0 0 0 5px var(--pink-l);transition:transform .3s}
.tl .item:hover::before{transform:scale(1.4)}
.tl small{color:var(--pink-d);font-weight:700}

/* SKILLS */
.bar{margin-bottom:30px}
.bar .top{display:flex;justify-content:space-between;margin-bottom:10px;font-weight:700}
.track{height:10px;background:var(--track);border-radius:20px;overflow:hidden}
.fill{height:100%;width:0;border-radius:20px;background:linear-gradient(90deg,#f08bb1,var(--pink));box-shadow:0 0 14px rgba(229,69,127,.45)}
html:not(.js) .fill{width:var(--w)}

/* CONTACT */
form.cf{max-width:560px;display:grid;gap:18px}
.cf input,.cf textarea{width:100%;background:var(--bg);border:1px solid var(--line);border-radius:18px;padding:16px 20px;color:var(--ink);font:inherit;transition:border-color .25s,box-shadow .25s,background-color .4s}
.cf textarea{min-height:140px;resize:vertical}
.cf input::placeholder,.cf textarea::placeholder{color:var(--ph)}
.cf input:focus,.cf textarea:focus{outline:none;border-color:var(--pink);box-shadow:0 0 0 4px rgba(229,69,127,.18)}
.cf button{border:0;cursor:pointer;background:var(--pink);color:#fff;font:700 1rem 'Nunito',sans-serif;padding:16px;border-radius:50px;box-shadow:var(--shadow);transition:background .25s,box-shadow .25s}
.cf button:hover{background:var(--hover);box-shadow:var(--shadow-h)}
footer.dark{border-top:1px solid var(--line);padding:38px 22px;display:flex;justify-content:center;gap:14px;flex-wrap:wrap}
footer.dark a{border:2px solid var(--pink);color:var(--pink);font-weight:700;padding:9px 26px;border-radius:50px;transition:background .25s,color .25s,box-shadow .25s}
footer.dark a:hover{background:var(--pink);color:#fff;box-shadow:var(--shadow-h)}

/* ===== ETAT INITIAL DES ANIMATIONS (GSAP les fait apparaitre) ===== */
.js .hero .inner,.js .hero .hg,.js .hero p.sub,.js .hero .btns,.js .hero .avatar{visibility:hidden}
.js .rv :is(h2,.back,.card,.part,.bar,.tl .item,.gal figure,form.cf):not(.seen),
.js .rv>p:not(.seen){opacity:0}

:focus-visible{outline:3px solid var(--pink);outline-offset:3px}
@media(max-width:760px){
  .hero .wrap{grid-template-columns:1fr;text-align:center}
  .hero p.sub{margin-inline:auto}.btns{justify-content:center}
  .avatar{order:-1;width:200px}
  nav .wrap{gap:12px}
  .navr{gap:10px}
  nav ul{gap:14px;font-size:.85rem;overflow-x:auto;white-space:nowrap;min-width:0;scrollbar-width:none}
  .logo{display:none}
  section{padding:70px 0}
}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}}
</style>
</head>
<body>
<div id="pt"></div>

<nav><div class="wrap">
  <a href="/" class="logo"><?= e($name) ?></a>
  <div class="navr">
  <ul>
    <li><a href="/#apropos"><?= t('À propos', 'About') ?></a></li>
    <li><a href="/#skills"><?= t('Compétences', 'Skills') ?></a></li>
    <li><a href="/#langues"><?= t('Langues', 'Languages') ?></a></li>
    <li><a href="/#parcours"><?= t('Parcours', 'Education') ?></a></li>
    <li><a href="/#modules"><?= t('Modules') ?></a></li>
    <li><a href="/#projets"><?= t('Projets', 'Projects') ?></a></li>
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

<?php elseif ($page === 'projets'): ?>
<!-- ===== PAGE PROJETS ===== -->
<section style="padding-top:50px"><div class="wrap rv">
  <a class="back" href="/#modules">&larr; <?= t('Retour', 'Back') ?></a><br>
  <h2><?= t('Mes projets', 'My projects') ?></h2>
  <div class="grid">
    <?php foreach ($projects as $i => $p): ?>
      <article class="card proj">
        <?php if (!empty($p['img'])): ?>
          <div class="thumb has-img"><img src="/imges/<?= e($p['img']) ?>" alt="<?= e(strip_tags($p['name'])) ?>" loading="lazy" onerror="this.style.display='none'"></div>
        <?php else: ?>
          <div class="thumb"><?= $i + 1 ?></div>
        <?php endif; ?>
        <h3><?= $p['name'] ?></h3>
        <p><?= $p['desc'] ?></p>
        <?php foreach ($p['tags'] as $tg): ?><span class="tag"><?= e($tg) ?></span><?php endforeach; ?>
        <a class="btn primary" style="margin-top:18px;padding:10px 24px" href="/?page=projet&amp;p=<?= e($p['slug']) ?>"><?= t('Voir le projet', 'View project') ?></a>
      </article>
    <?php endforeach; ?>
  </div>
</div></section>

<?php elseif ($page === 'projet'): ?>
<!-- ===== PAGE D'UN PROJET : carte principale + cartes 01 / 02 / 03 ===== -->
<?php
  $cur = null;
  foreach ($projects as $pp) { if (($pp['slug'] ?? '') === $pslug) { $cur = $pp; break; } }
?>
<section style="padding-top:50px"><div class="wrap rv">
  <a class="back" href="/?page=projets">&larr; <?= t('Retour aux projets', 'Back to projects') ?></a>
  <?php if ($cur): ?>
    <div class="card pj-wrap">
      <div class="pj-head">
        <?php if (!empty($cur['img'])): ?>
          <img src="/imges/<?= e($cur['img']) ?>" alt="<?= e(strip_tags($cur['name'])) ?>" onerror="this.style.display='none'">
        <?php endif; ?>
        <div>
          <h2 style="margin-bottom:12px"><?= $cur['name'] ?></h2>
          <p style="margin:0"><?= $cur['desc'] ?></p>
        </div>
      </div>
      <?php if (!empty($cur['parts'])): ?>
        <div class="pj-sep"></div>
        <div class="pj-parts">
          <?php foreach ($cur['parts'] as $k => $part): ?>
            <div class="part">
              <span class="badge"><?= sprintf('%02d', $k + 1) ?></span>
              <h3><?= $part['title'] ?></h3>
              <p><?= $part['desc'] ?></p>
              <?php if (!empty($part['links'])): ?>
                <div class="links">
                  <?php foreach ($part['links'] as $lk): ?>
                    <a href="<?= e($lk[1]) ?>" target="_blank" rel="noopener"><?= $lk[0] ?> &rarr;</a>
                  <?php endforeach; ?>
                </div>
              <?php else: ?>
                <span class="soon"><?= t('Support à ajouter', 'Material to be added') ?></span>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <div class="card"><p style="margin:0"><?= t('Projet introuvable.', 'Project not found.') ?></p></div>
  <?php endif; ?>
</div></section>

<?php elseif ($page === 'agile' && $view === 'tp' && !$atelier): ?>
<!-- ===== TP : LES 6 ATELIERS ===== -->
<section style="padding-top:50px"><div class="wrap rv">
  <a class="back" href="/?page=agile">&larr; <?= t('Retour', 'Back') ?></a><br>
  <h2><?= t('TP', 'Labs (TP)') ?> &middot; <?= t('Approche agile', 'Agile approach') ?></h2>
  <div class="grid">
    <?php for ($n = 1; $n <= 6; $n++): $cnt = count(agile_imgs("tp/atelier$n")); ?>
      <div class="card big">
        <div class="ico"><b style="font-family:'Fraunces',serif;font-size:2.4rem"><?= $n ?></b></div>
        <h3><?= t("Atelier $n", "Workshop $n") ?></h3>
        <?php if ($cnt): ?><span class="tag"><?= $cnt ?> images</span><br><?php endif; ?>
        <a class="btn primary" href="/?page=agile&amp;view=tp&amp;atelier=<?= $n ?>"><?= t("Voir l'atelier", 'View workshop') ?></a>
      </div>
    <?php endfor; ?>
  </div>
</div></section>

<?php elseif ($page === 'agile' && $view): ?>
<!-- ===== GALERIE : COURS ou ATELIER (tswar) ===== -->
<?php
  $isTp  = ($view === 'tp');
  $isAt  = ($isTp && $atelier);
  $key   = $isAt ? "tp/atelier$atelier" : $view;
  $imgs  = agile_imgs($key);
  $back  = $isAt ? '/?page=agile&amp;view=tp' : '/?page=agile';
  $title = $isAt ? t("Atelier $atelier", "Workshop $atelier") : ($isTp ? t('TP', 'Labs (TP)') : t('Cours', 'Lessons'));
?>
<section style="padding-top:50px"><div class="wrap rv">
  <a class="back" href="<?= $back ?>">&larr; <?= t('Retour', 'Back') ?></a><br>
  <h2><?= $title ?> &middot; <?= t('Approche agile', 'Agile approach') ?></h2>
  <?php if ($imgs): ?>
    <div class="gal">
      <?php foreach ($imgs as $i => $f): ?>
        <figure>
          <img src="/imges/agile/<?= e($key) ?>/<?= e(rawurlencode($f)) ?>" alt="<?= $i + 1 ?>" loading="lazy">
          <figcaption><?= $isAt ? "Atelier $atelier" : ($isTp ? 'TP' : 'Cours') ?> &middot; <?= $i + 1 ?></figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="card"><p style="margin:0"><?= t("Pas encore d'images. Ajoute-les dans public/imges/agile/$key/", "No images yet. Add them in public/imges/agile/$key/") ?></p></div>
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
      ['tp',    t('TP', 'Labs (TP)'),  t('Les 6 ateliers du module, en images.', 'The 6 workshops of the module, as images.'), t('Voir les ateliers', 'View workshops')],
    ];
    foreach ($cards as $c): $n = ($c[0] === 'cours') ? count(agile_imgs('cours')) : 0; ?>
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

<header class="hero" id="top"><div class="blob b1"></div><div class="blob b2"></div><div class="wrap">
  <div>
    <p class="hg"><?= t('Salut, je suis', "Hi, I'm") ?></p>
    <h1><span class="line"><span class="inner"><?= e($name) ?></span></span><span class="line role"><span class="inner"><?= $role ?></span></span></h1>
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

<!-- bande qui defile (GSAP) : kat3red les competences -->
<?php $mq = array_merge(array_keys($skills), ['Full Stack', 'Git']); ?>
<div class="marquee" aria-hidden="true"><div class="mq-track">
  <?php for ($c = 0; $c < 4; $c++): ?>
    <div class="mq-half"><?php foreach ($mq as $w): ?><span><?= e($w) ?></span><i>&#10022;</i><?php endforeach; ?></div>
  <?php endfor; ?>
</div></div>

<section id="apropos"><div class="wrap rv">
  <h2><?= t('À propos', 'About') ?></h2>
  <div class="card"><p style="margin:0;font-size:1.05rem;color:var(--ink)"><?= $about ?></p></div>
</div></section>

<section id="skills" class="dark"><div class="wrap rv">
  <h2><?= t('Compétences', 'Skills') ?></h2>
  <?php foreach ($skills as $label => $pct): ?>
    <div class="bar">
      <div class="top"><span><?= e($label) ?></span><span class="pct"><?= (int)$pct ?>%</span></div>
      <div class="track"><div class="fill" data-w="<?= (int)$pct ?>" style="--w:<?= (int)$pct ?>%"></div></div>
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

<!-- 2 cartes : Modules + Projets (kol wa7da fiha tswira) -->
<section id="modules"><div class="wrap rv">
  <div class="teasers">
    <div class="card teaser">
      <?= cover('modules.jpg', '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v16H6.5A2.5 2.5 0 0 0 4 21.5z"/><path d="M4 19V5.5"/><path d="M9 7h7M9 11h5"/></svg>') ?>
      <h3><?= t('Mes modules', 'My modules') ?></h3>
      <p><?= t("Découvre les modules que j'étudie en Développement Digital, option Full Stack.", "Discover the modules I study in Digital Development, Full Stack option.") ?></p>
      <a class="btn primary" href="/?page=modules"><?= t('Voir les modules', 'View modules') ?></a>
    </div>
    <div class="card teaser" id="projets">
      <?= cover('projets.jpg', '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="12" rx="2"/><path d="M2 20h20"/><path d="M10 8.5 8 10.5l2 2M14 8.5l2 2-2 2"/></svg>') ?>
      <h3><?= t('Mes projets', 'My projects') ?></h3>
      <p><?= t("Découvre les projets que j'ai réalisés pendant ma formation.", "Discover the projects I built during my training.") ?></p>
      <a class="btn primary" href="/?page=projets"><?= t('Voir les projets', 'View projects') ?></a>
    </div>
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

<!-- GSAP (animations) + ScrollTrigger + Lenis (smooth scroll) -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js"></script>
<script>
// Kayft'7 l'email app b message m3emmer (bla backend)
var cfEl=document.getElementById('cf');
if(cfEl)cfEl.addEventListener('submit',function(ev){
  ev.preventDefault();
  const n=document.getElementById('cn').value,m=document.getElementById('ce').value,t=document.getElementById('cm').value;
  location.href='mailto:<?= e($email) ?>?subject='+encodeURIComponent((document.documentElement.lang==='en'?'Message from ':'Message de ')+n)+'&body='+encodeURIComponent(t+'\n\n'+n+' ('+m+')');
});
// Lightbox (kat-wqqf Lenis mli tkoun m7loula)
var lb=document.getElementById('lb');
if(lb){
  document.querySelectorAll('.gal img').forEach(function(im){im.addEventListener('click',function(){lb.querySelector('img').src=im.src;lb.classList.add('on');if(window.lenis)window.lenis.stop()})});
  lb.addEventListener('click',function(){lb.classList.remove('on');if(window.lenis)window.lenis.start()});
}
setLang(document.documentElement.lang); // applique la langue sauvegardée

/* ================= GSAP + LENIS ================= */
(function(){
  var root=document.documentElement;
  // ila les librairies ma t-charjatch => l'site kaybqa khddam b7al 9bl
  if(!window.gsap||!window.ScrollTrigger||!window.Lenis){root.classList.remove('js');return;}
  gsap.registerPlugin(ScrollTrigger);

  /* 1) LENIS : scroll nasi3 */
  var lenis=new Lenis({duration:1.15,easing:function(t){return Math.min(1,1.001-Math.pow(2,-10*t))}});
  window.lenis=lenis;
  lenis.on('scroll',ScrollTrigger.update);
  gsap.ticker.add(function(time){lenis.raf(time*1000)});
  gsap.ticker.lagSmoothing(0);

  /* 2) NAVBAR : kat-tkhba mli tnzel, kat-tban mli tsle9 */
  var nav=document.querySelector('nav'),last=0;
  lenis.on('scroll',function(e){
    var y=e.scroll;
    gsap.to(nav,{yPercent:(y>last&&y>140)?-100:0,duration:.4,ease:'power3.out',overwrite:true});
    last=y;
  });

  /* 3) INTRO : l'rideau rose kayn9ss, morra l'hero kayban */
  var pt=document.getElementById('pt');
  var tl=gsap.timeline({defaults:{ease:'power4.out'}});
  tl.to(pt,{scaleY:0,duration:.8,ease:'power4.inOut'});
  if(document.querySelector('.hero')){
    tl.fromTo('.hero .inner',{yPercent:115,autoAlpha:0},{yPercent:0,autoAlpha:1,duration:1.1,stagger:.12},'-=.35')
      .fromTo('.hero .hg,.hero p.sub,.hero .btns',{y:30,autoAlpha:0},{y:0,autoAlpha:1,duration:.8,stagger:.12},'-=.8')
      .fromTo('.hero .avatar',{scale:.6,rotation:-12,autoAlpha:0},{scale:1,rotation:0,autoAlpha:1,duration:1.2,ease:'elastic.out(1,.7)'},'-=1')
      .add(function(){gsap.to('.hero .avatar',{y:-14,duration:2.6,ease:'sine.inOut',repeat:-1,yoyo:true})});
    // parallax dyal les cercles rose f l'hero
    gsap.to('.b1',{y:220,ease:'none',scrollTrigger:{trigger:'.hero',start:'top top',end:'bottom top',scrub:true}});
    gsap.to('.b2',{y:-140,ease:'none',scrollTrigger:{trigger:'.hero',start:'top top',end:'bottom top',scrub:true}});
  }

  /* 4) MARQUEE : defilement infini */
  if(document.querySelector('.mq-track')){
    gsap.to('.mq-track',{xPercent:-50,duration:30,ease:'none',repeat:-1});
  }

  /* 5) APPARITION AU SCROLL (par groupes, avec stagger) */
  var sel='.rv h2,.rv>p,.rv .back,.rv .card,.rv .part,.rv .bar,.rv .tl .item,.rv .gal figure,.rv form.cf';
  ScrollTrigger.batch(sel,{
    start:'top 90%',once:true,
    onEnter:function(els){
      gsap.fromTo(els,{y:60,opacity:0},{
        y:0,opacity:1,duration:.9,ease:'power3.out',stagger:.1,overwrite:true,
        onStart:function(){els.forEach(function(el){el.style.transition='none'})},
        onComplete:function(){els.forEach(function(el){el.style.transition='';el.style.transform='';el.style.opacity='';el.classList.add('seen')})}
      });
    }
  });

  /* 6) COMPETENCES : barres + compteur 0 -> % */
  gsap.utils.toArray('.bar').forEach(function(bar){
    var f=bar.querySelector('.fill'),n=bar.querySelector('.pct');
    if(!f)return;
    var v=parseInt(f.dataset.w,10)||0,o={v:0};
    if(n)n.textContent='0%';
    ScrollTrigger.create({trigger:bar,start:'top 90%',once:true,onEnter:function(){
      gsap.to(f,{width:v+'%',duration:1.6,ease:'power3.out'});
      gsap.to(o,{v:v,duration:1.6,ease:'power3.out',onUpdate:function(){if(n)n.textContent=Math.round(o.v)+'%'}});
    }});
  });

  /* 7) LANGUES : les points kay-tbanou wa7d wa7d */
  gsap.utils.toArray('.lang-card').forEach(function(card){
    var dots=card.querySelectorAll('.dots span');
    gsap.set(dots,{scale:0});
    ScrollTrigger.create({trigger:card,start:'top 90%',once:true,onEnter:function(){
      gsap.to(dots,{scale:1,duration:.5,stagger:.1,ease:'back.out(2.5)',delay:.3});
    }});
  });

  /* 8) BOUTONS MAGNETIQUES (ghir 3la souris) */
  if(window.matchMedia('(pointer:fine)').matches){
    document.querySelectorAll('.btn,.tg,.lg,footer.dark a,.cf button').forEach(function(el){
      var qx=gsap.quickTo(el,'x',{duration:.5,ease:'power3'}),qy=gsap.quickTo(el,'y',{duration:.5,ease:'power3'});
      el.addEventListener('mousemove',function(e){
        var r=el.getBoundingClientRect();
        qx((e.clientX-r.left-r.width/2)*.28);qy((e.clientY-r.top-r.height/2)*.38);
      });
      el.addEventListener('mouseleave',function(){qx(0);qy(0)});
    });
  }

  /* 9) LIENS : #ancres => Lenis, pages => rideau rose */
  document.addEventListener('click',function(e){
    var a=e.target.closest('a');if(!a)return;
    var h=a.getAttribute('href');
    if(!h||a.target==='_blank'||a.hasAttribute('download')||e.metaKey||e.ctrlKey||e.shiftKey)return;
    var home=!location.search&&(location.pathname==='/'||location.pathname.indexOf('index.php')>-1);
    if(h.charAt(0)==='#'||(h.indexOf('/#')===0&&home)){
      e.preventDefault();lenis.scrollTo(h.replace('/',''),{offset:-70});return;
    }
    if(h==='/'&&home){e.preventDefault();lenis.scrollTo(0);return;}
    if(h.charAt(0)==='/'&&h.indexOf('//')!==0){
      e.preventDefault();
      gsap.set(pt,{transformOrigin:'bottom'});
      gsap.to(pt,{scaleY:1,duration:.6,ease:'power4.inOut',onComplete:function(){location.href=h}});
    }
  });
  window.addEventListener('pageshow',function(ev){if(ev.persisted)gsap.set(pt,{scaleY:0})});

  // ila l'lien fih #ancre (mital /#modules) => 7ett l'page 3la dik l'blasa
  if(location.hash){setTimeout(function(){lenis.scrollTo(location.hash,{immediate:true,offset:-70})},60)}
  window.addEventListener('load',function(){ScrollTrigger.refresh()});
})();
</script>
</body>
</html>