<?php

$name = "Chaimae Salah";
$job = "Développeuse Web";

$description =
    "Je crée des sites web modernes, élégants et interactifs.";

?>

<!DOCTYPE html>

<html lang="fr">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title><?php echo $name; ?> | Portfolio</title>


<style>

/* =====================================
   RESET
===================================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
}


body {

    font-family: Arial, sans-serif;

    background: #0A0A0A;

    color: #E8D8C3;

}


a {
    text-decoration: none;
    color: inherit;
}


/* =====================================
   COLORS
===================================== */

:root {

    --black: #0A0A0A;

    --black2: #11100F;

    --dark: #1A1714;

    --gray: #292522;

    --gray-text: #A99B8C;

    --caramel: #B8793D;

    --caramel-dark: #8B5428;

    --beige: #E8D8C3;

}


/* =====================================
   NAVBAR
===================================== */

nav {

    position: fixed;

    top: 0;
    left: 0;

    width: 100%;

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 20px 8%;

    background: rgba(10,10,10,0.90);

    backdrop-filter: blur(12px);

    border-bottom: 1px solid #292522;

    z-index: 1000;

}


.logo {

    font-size: 26px;

    font-weight: bold;

    letter-spacing: 1px;

}


.logo span {

    color: var(--caramel);

}


.nav-links {

    display: flex;

    gap: 30px;

    list-style: none;

}


.nav-links a {

    color: var(--beige);

    transition: 0.3s;

}


.nav-links a:hover {

    color: var(--caramel);

}


/* =====================================
   HERO
===================================== */

#home {

    min-height: 100vh;

    display: flex;

    justify-content: center;

    align-items: center;

    padding: 100px 8%;

    background:

        radial-gradient(
            circle at 80% 30%,
            rgba(184,121,61,0.18),
            transparent 28%
        ),

        #0A0A0A;

}


.hero {

    width: 100%;

    max-width: 1100px;

    display: flex;

    justify-content: space-between;

    align-items: center;

    gap: 60px;

}


.hero-text {

    animation: slideLeft 1s ease;

}


.hero-text small {

    color: var(--gray-text);

    font-size: 18px;

}


.hero-text h1 {

    font-size: 65px;

    margin: 15px 0;

    color: var(--beige);

}


.hero-text h1 span {

    color: var(--caramel);

}


.typing {

    font-size: 25px;

    color: var(--caramel);

    border-right: 3px solid var(--caramel);

    padding-right: 6px;

}


.hero-text p {

    margin: 25px 0;

    color: var(--gray-text);

    line-height: 1.8;

    max-width: 550px;

}


/* =====================================
   BUTTON
===================================== */

.btn {

    display: inline-block;

    background: var(--caramel);

    color: #0A0A0A;

    padding: 13px 28px;

    border-radius: 5px;

    font-weight: bold;

    transition: 0.3s;

}


.btn:hover {

    background: #D19A62;

    transform: translateY(-5px);

    box-shadow:

        0 10px 30px rgba(184,121,61,0.30);

}


/* =====================================
   PROFILE
===================================== */

.profile {

    width: 300px;

    height: 300px;

    flex-shrink: 0;

    border-radius: 50%;

    border: 2px solid var(--caramel);

    display: flex;

    justify-content: center;

    align-items: center;

    background:

        radial-gradient(
            circle,
            #292522,
            #11100F
        );

    box-shadow:

        0 0 40px rgba(184,121,61,0.25),

        inset 0 0 40px rgba(184,121,61,0.08);

    animation: floating 3s ease-in-out infinite;

}


.profile span {

    font-size: 100px;

}


/* =====================================
   SECTIONS
===================================== */

section {

    padding: 100px 8%;

}


.section-title {

    text-align: center;

    margin-bottom: 60px;

}


.section-title h2 {

    font-size: 40px;

    color: var(--beige);

}


.section-title span {

    color: var(--caramel);

}


.section-title p {

    color: var(--gray-text);

    margin-top: 10px;

}


/* =====================================
   ABOUT
===================================== */

#about {

    background: #11100F;

}


.about-box {

    max-width: 900px;

    margin: auto;

    background: #1A1714;

    padding: 40px;

    border-left: 4px solid var(--caramel);

    border-radius: 8px;

    transition: 0.4s;

}


.about-box:hover {

    transform: translateY(-8px);

    box-shadow:

        0 20px 40px rgba(0,0,0,0.5);

}


.about-box p {

    color: var(--gray-text);

    line-height: 1.8;

}


/* =====================================
   SKILLS
===================================== */

.skills-container {

    max-width: 900px;

    margin: auto;

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 20px;

}


.skill {

    background: #181512;

    padding: 30px;

    text-align: center;

    border-radius: 8px;

    border: 1px solid #302A25;

    transition: 0.4s;

}


.skill:hover {

    transform: translateY(-10px);

    border-color: var(--caramel);

    box-shadow:

        0 10px 30px
        rgba(184,121,61,0.20);

}


.skill h3 {

    margin-bottom: 10px;

    color: var(--beige);

}


.skill p {

    color: var(--gray-text);

}


/* =====================================
   PROJECTS
===================================== */

#projects {

    background: #11100F;

}


.projects-container {

    max-width: 1000px;

    margin: auto;

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 25px;

}


.project {

    background: #181512;

    padding: 30px;

    border-radius: 10px;

    border: 1px solid #302A25;

    transition: 0.4s;

}


.project:hover {

    transform:

        translateY(-10px)
        scale(1.02);

    border-color: var(--caramel);

    box-shadow:

        0 15px 40px
        rgba(184,121,61,0.20);

}


.project-icon {

    font-size: 45px;

    margin-bottom: 20px;

}


.project h3 {

    margin-bottom: 15px;

    color: var(--beige);

}


.project p {

    color: var(--gray-text);

    line-height: 1.6;

}


/* =====================================
   CONTACT
===================================== */

.contact-box {

    max-width: 700px;

    margin: auto;

    background: #181512;

    padding: 40px;

    border-radius: 10px;

    border: 1px solid #302A25;

}


input,
textarea {

    width: 100%;

    padding: 15px;

    margin-bottom: 15px;

    background: #0E0D0C;

    border: 1px solid #302A25;

    color: var(--beige);

    border-radius: 5px;

    outline: none;

}


input:focus,
textarea:focus {

    border-color: var(--caramel);

    box-shadow:

        0 0 10px
        rgba(184,121,61,0.15);

}


textarea {

    height: 150px;

    resize: none;

}


button {

    border: none;

    cursor: pointer;

    font-size: 16px;

}


/* =====================================
   FOOTER
===================================== */

footer {

    text-align: center;

    padding: 30px;

    background: #080808;

    color: #70665D;

}


footer span {

    color: var(--caramel);

}


/* =====================================
   ANIMATIONS
===================================== */

@keyframes floating {

    0%, 100% {

        transform: translateY(0);

    }

    50% {

        transform: translateY(-20px);

    }

}


@keyframes slideLeft {

    from {

        opacity: 0;

        transform:
            translateX(-80px);

    }

    to {

        opacity: 1;

        transform:
            translateX(0);

    }

}


/* =====================================
   RESPONSIVE
===================================== */

@media(max-width: 800px) {

    .nav-links {

        display: none;

    }


    .hero {

        flex-direction: column-reverse;

        text-align: center;

    }


    .hero-text h1 {

        font-size: 45px;

    }


    .profile {

        width: 220px;

        height: 220px;

    }


    .skills-container,
    .projects-container {

        grid-template-columns: 1fr;

    }

}

</style>

</head>


<body>


<!-- ==============================
     NAVBAR
============================== -->

<nav>

    <div class="logo">

        Port<span>folio</span>

    </div>


    <ul class="nav-links">

        <li>
            <a href="#home">Accueil</a>
        </li>

        <li>
            <a href="#about">À propos</a>
        </li>

        <li>
            <a href="#skills">Compétences</a>
        </li>

        <li>
            <a href="#projects">Projets</a>
        </li>

        <li>
            <a href="#contact">Contact</a>
        </li>

    </ul>

</nav>


<!-- ==============================
     HOME
============================== -->

<section id="home">

    <div class="hero">


        <div class="hero-text">

            <small>
                Bonjour, je suis
            </small>


            <h1>

                <?php echo $name; ?>

            </h1>


            <div
                class="typing"
                id="typing">
            </div>


            <p>

                <?php echo $description; ?>

                Je suis passionnée par le
                développement web et la
                création de projets modernes.

            </p>


            <a
                href="#projects"
                class="btn">

                Voir mes projets

            </a>

        </div>


        <div class="profile">

            <span>💻</span>

        </div>


    </div>

</section>


<!-- ==============================
     ABOUT
============================== -->

<section id="about">


    <div class="section-title">

        <h2>

            À <span>propos</span>

        </h2>


        <p>

            Découvrez mon parcours

        </p>

    </div>


    <div class="about-box">

        <p>

            Je suis une développeuse web
            passionnée par la programmation
            et les nouvelles technologies.

            J'aime créer des interfaces
            modernes, simples et agréables
            à utiliser.

        </p>

    </div>

</section>


<!-- ==============================
     SKILLS
============================== -->

<section id="skills">


    <div class="section-title">

        <h2>

            Mes <span>compétences</span>

        </h2>


        <p>

            Les technologies que j'apprends

        </p>

    </div>


    <div class="skills-container">


        <div class="skill">

            <h3>HTML</h3>

            <p>
                Structure des sites web.
            </p>

        </div>


        <div class="skill">

            <h3>CSS</h3>

            <p>
                Design et animations.
            </p>

        </div>


        <div class="skill">

            <h3>JavaScript</h3>

            <p>
                Interfaces interactives.
            </p>

        </div>


        <div class="skill">

            <h3>PHP</h3>

            <p>
                Développement côté serveur.
            </p>

        </div>


        <div class="skill">

            <h3>Python</h3>

            <p>
                Programmation et logique.
            </p>

        </div>


        <div class="skill">

            <h3>MySQL</h3>

            <p>
                Bases de données.
            </p>

        </div>


    </div>

</section>


<!-- ==============================
     PROJECTS
============================== -->

<section id="projects">


    <div class="section-title">

        <h2>

            Mes <span>projets</span>

        </h2>


        <p>

            Quelques projets réalisés

        </p>

    </div>


    <div class="projects-container">


        <div class="project">

            <div class="project-icon">
                🛒
            </div>

            <h3>
                Online Shop
            </h3>

            <p>

                Site e-commerce avec
                produits, panier et
                système de gestion.

            </p>

        </div>


        <div class="project">

            <div class="project-icon">
                📚
            </div>

            <h3>
                Bibliothèque
            </h3>

            <p>

                Site web moderne pour
                présenter des livres.

            </p>

        </div>


        <div class="project">

            <div class="project-icon">
                💼
            </div>

            <h3>
                Portfolio
            </h3>

            <p>

                Portfolio personnel
                présentant mes compétences.

            </p>

        </div>


    </div>

</section>


<!-- ==============================
     CONTACT
============================== -->

<section id="contact">


    <div class="section-title">

        <h2>

            Me <span>contacter</span>

        </h2>


        <p>

            Envoyez-moi un message

        </p>

    </div>


    <div class="contact-box">


        <form>

            <input
                type="text"
                placeholder="Votre nom"
                required
            >


            <input
                type="email"
                placeholder="Votre email"
                required
            >


            <textarea
                placeholder="Votre message"
                required
            ></textarea>


            <button
                class="btn"
                type="submit">

                Envoyer

            </button>

        </form>


    </div>

</section>


<!-- ==============================
     FOOTER
============================== -->

<footer>

    © 2026

    <span>

        <?php echo $name; ?>

    </span>

    — Tous droits réservés.

</footer>


<script>

/* =================================
   TYPING ANIMATION
================================= */

const texts = [

    "Développeuse Web",

    "Full Stack Developer",

    "Passionnée par le code",

    "Future Ingénieure Informatique"

];


let textIndex = 0;

let charIndex = 0;


const typing =
    document.getElementById("typing");


function typeEffect() {


    if (
        charIndex <
        texts[textIndex].length
    ) {


        typing.textContent +=

            texts[textIndex]
            .charAt(charIndex);


        charIndex++;


        setTimeout(
            typeEffect,
            80
        );


    }

    else {


        setTimeout(
            deleteEffect,
            1500
        );

    }

}


function deleteEffect() {


    if (charIndex > 0) {


        typing.textContent =

            texts[textIndex]
            .substring(
                0,
                charIndex - 1
            );


        charIndex--;


        setTimeout(
            deleteEffect,
            50
        );


    }

    else {


        textIndex++;


        if (
            textIndex >=
            texts.length
        ) {

            textIndex = 0;

        }


        setTimeout(
            typeEffect,
            300
        );

    }

}


typeEffect();


/* =================================
   SCROLL ANIMATION
================================= */

const elements =

    document.querySelectorAll(
        ".skill, .project, .about-box"
    );


const observer =

    new IntersectionObserver(

        entries => {


            entries.forEach(
                entry => {


                    if (
                        entry.isIntersecting
                    ) {


                        entry.target.style.opacity =
                            "1";


                        entry.target.style.transform =
                            "translateY(0)";

                    }

                }
            );

        },

        {
            threshold: 0.2
        }

    );


elements.forEach(
    element => {


        element.style.opacity =
            "0";


        element.style.transform =
            "translateY(40px)";


        element.style.transition =
            "0.7s";


        observer.observe(element);

    }
);

</script>


</body>

</html>