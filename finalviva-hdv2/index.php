<?php
session_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Police Manegment System</title>

  <!-- stylesheet -->
  <link rel="stylesheet" href="style.css" />

  <!-- google fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet" />

  <!-- icons -->
  <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>

  <!-- gsap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>

  <!-- AnimeJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>

  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.min.js"></script>
</head>

<body>
  <header>
    <div class="logo">
      <a href=""></a>
    </div>
    <nav>
      <ul>
        <li><a href="">Home</a></li>
        <li><a href="">About</a></li>
        <li>
          <a href="http://localhost/finalviva-hdv2/LoginpageDriver/index.php">Driver</a>
        </li>
        <li>
          <a href="http://localhost/finalviva-hdv2/LoginPageOfficer/login.php">Officer</a>
        </li>
        <li><a href="">Feedback</a></li>
        <li>
          <a href="http://localhost/finalviva-hdv2/ContactFrom_v1/">Contact</a>
        </li>
      </ul>
    </nav>
    <div class="trigger-main">
      <a href="#" class="hamBurger">
        <span class="one"></span>
        <span class="two"></span>
      </a>
    </div>
  </header>

  <section class="banner"></section>

  <script>
    const hamBurger = document.querySelector(".hamBurger");
    const nav = document.querySelector("nav");

    hamBurger.addEventListener("click", function() {
      nav.classList.toggle("open");
      hamBurger.classList.toggle("close");
    });
  </script>

  <div class="container">
    <div class="loading-screen"></div>

    <div class="loader">
      <div class="ringOne ring">
        <img src="ring.png" alt="" />
      </div>
      <div class="ringTwo ring">
        <img src="ring.png" alt="" />
      </div>
    </div>
  </div>

  <div class="logo">
    <ion-icon name="git-compare"></ion-icon>Sri LANKA
  </div>

  <div class="contact">MENU</div>

  <div class="header">
    <h1 class="ml7" id="title">
      <span class="text-wrapper">
        <span class="letters">Police Manegment System</span>
      </span>
    </h1>

    <p id="tagline" class="p1">
      <b>
        Sri Lanka Police is the civilian national police force of the
        Democratic Socialist Republic of Sri Lanka. The police force has a
        manpower of approximately 77,000, and is responsible for enforcing
        criminal- and traffic law, enhancing public safety, maintaining order
        and keeping the peace throughout Sri Lanka</b>
    </p>

    <br /><br />

    <div class="buttons">
      <button id="one">LEARN MORE</button>
      <button id="two">FEEDBACK</button>
    </div>
  </div>

  <div class="media">
    <ul>
      <li>
        <ion-icon name="logo-facebook"></ion-icon>
      </li>
      <li>
        <ion-icon name="logo-instagram"></ion-icon>
      </li>
      <li>
        <ion-icon name="logo-twitter"></ion-icon>
      </li>
      <li>
        <ion-icon name="logo-youtube"></ion-icon>
      </li>
    </ul>
  </div>

  <!-- js -->
  <script src="script.js"></script>
</body>

</html>