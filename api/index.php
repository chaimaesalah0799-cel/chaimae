<?php
header('Cache-Control: no-cache, must-revalidate'); // bach dima yban l'version jdida
// ====== MODIFIE GHIR HNA ======
$name     = "Chaimae Salah";
$role     = "Développeuse Full Stack";
$school   = "ISTA NTIC Tanger";
$email    = "chaimae@email.com";
$github   = "https://github.com/ton-username";
$linkedin = "https://linkedin.com/in/ton-username";
$cv       = "/docs/cv.pdf";           // 7et CV f public/docs/
$photo    = "/imges/photo.jpg";       // 7et tswira f public/imges/ (optionnel)

$about = "Étudiante en 2ème année Développement Digital option Full Stack à l'ISTA NTIC Tanger. Je construis des applications web complètes, de l'interface jusqu'à la base de données, avec un souci du détail.";

$instagram = "https://instagram.com/ton-username";

// smiya => pourcentage (kun sadqa f l'arqam)
$skills = [
  "HTML / CSS"   => 90,
  "JavaScript"   => 80,
  "PHP / MySQL"  => 75,
  "UI / UX Design" => 70,
];

$projects = [
  ["title" => "Projet 1", "desc" => "Application de gestion avec authentification et CRUD complet.", "tech" => ["PHP", "MySQL", "Bootstrap"], "github" => "#", "demo" => "#"],
  ["title" => "Projet 2", "desc" => "Site e-commerce responsive avec panier et espace admin.", "tech" => ["Laravel", "JavaScript"], "github" => "#", "demo" => "#"],
  ["title" => "Projet 3", "desc" => "Application web en temps réel avec API REST.", "tech" => ["React", "Node.js"], "github" => "#", "demo" => "#"],
];

$parcours = [
  ["2024 – 2026", "Développement Digital, option Full Stack", $school],
  ["2025", "Stage", "Ajoute ton stage ici"],
];
function e($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
try{var t=localStorage.getItem('theme');if(t)document.documentElement.setAttribute('data-theme',t)}catch(e){}
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
  nav ul{gap:14px;font-size:.85rem;overflow-x:auto;white-space:nowrap;min-width:0;scrollbar-width:none}
  .logo{display:none}
}
@media(prefers-reduced-motion:reduce){*{animation:none!important;transition:none!important}.rv,.hero .wrap>div:first-child>*{opacity:1;transform:none}}
</style>
</head>
<body>

<nav><div class="wrap">
  <a href="#top" class="logo"><?= e($name) ?></a>
  <div class="navr">
  <ul>
    <li><a href="#apropos">À propos</a></li>
    <li><a href="#skills">Skills</a></li>
    <li><a href="#projets">Projets</a></li>
    <li><a href="#parcours">Parcours</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
  <button class="tg" type="button" onclick="toggleTheme()" aria-label="Changer les couleurs du site (noir / pink)" title="Noir / Pink"><span class="ic-moon">&#127769;</span><span class="ic-sun">&#9728;&#65039;</span></button>
  </div>
</div></nav>

<header class="hero" id="top"><div class="wrap">
  <div>
    <p style="color:var(--pink-d);font-weight:700">Salut, je suis</p>
    <h1><?= e($name) ?><br><span><?= e($role) ?></span></h1>
    <p class="sub">Étudiante à <?= e($school) ?>. Je crée des sites et applications web complets, du design à la base de données.</p>
    <div class="btns">
      <a class="btn primary" href="#projets">Voir mes projets</a>
      <a class="btn ghost" href="<?= e($cv) ?>" download>Télécharger mon CV</a>
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
  <h2>À propos</h2>
  <div class="card"><p style="margin:0;font-size:1.05rem;color:var(--ink)"><?= e($about) ?></p></div>
</div></section>

<section id="skills" class="dark"><div class="wrap rv">
  <h2>Skills</h2>
  <?php foreach ($skills as $label => $pct): ?>
    <div class="bar">
      <div class="top"><span><?= e($label) ?></span><span><?= (int)$pct ?>%</span></div>
      <div class="track"><div class="fill" style="--w:<?= (int)$pct ?>%"></div></div>
    </div>
  <?php endforeach; ?>
</div></section>

<section id="projets"><div class="wrap rv">
  <h2>Projets</h2>
  <div class="grid">
    <?php foreach ($projects as $p): ?>
      <article class="card proj">
        <div class="thumb"><?= e(mb_substr($p['title'], 0, 1)) ?></div>
        <h3><?= e($p['title']) ?></h3>
        <p><?= e($p['desc']) ?></p>
        <?php foreach ($p['tech'] as $t): ?><span class="tag"><?= e($t) ?></span><?php endforeach; ?>
        <div class="links">
          <a href="<?= e($p['github']) ?>" target="_blank" rel="noopener">GitHub</a>
          <a href="<?= e($p['demo']) ?>" target="_blank" rel="noopener">Démo</a>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</div></section>

<section id="parcours"><div class="wrap rv">
  <h2>Parcours</h2>
  <div class="tl">
    <?php foreach ($parcours as $x): ?>
      <div class="item"><small><?= e($x[0]) ?></small><h3><?= e($x[1]) ?></h3><p style="color:var(--muted)"><?= e($x[2]) ?></p></div>
    <?php endforeach; ?>
  </div>
</div></section>

<section id="contact" class="dark"><div class="wrap rv">
  <h2>Contact</h2>
  <form class="cf" id="cf">
    <input type="text" id="cn" placeholder="Smitek" required>
    <input type="email" id="ce" placeholder="Email dyalek" required>
    <textarea id="cm" placeholder="Message dyalek" required></textarea>
    <button type="submit">Sift message</button>
  </form>
</div></section>

<footer class="dark">
  <a href="<?= e($github) ?>" target="_blank" rel="noopener">GitHub</a>
  <a href="<?= e($linkedin) ?>" target="_blank" rel="noopener">LinkedIn</a>
  <a href="<?= e($instagram) ?>" target="_blank" rel="noopener">Instagram</a>
</footer>

<script>
// Kayft'7 l'email app b message m3emmer (bla backend)
document.getElementById('cf').addEventListener('submit',function(ev){
  ev.preventDefault();
  const n=document.getElementById('cn').value,m=document.getElementById('ce').value,t=document.getElementById('cm').value;
  location.href='mailto:<?= e($email) ?>?subject='+encodeURIComponent('Message mn '+n)+'&body='+encodeURIComponent(t+'\n\n'+n+' ('+m+')');
});
const io=new IntersectionObserver(es=>es.forEach(x=>{if(x.isIntersecting){x.target.classList.add('show');io.unobserve(x.target)}}),{threshold:.12});
document.querySelectorAll('.rv').forEach(el=>io.observe(el));
</script>
</body>
</html>