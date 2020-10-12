<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<header>
  <div class="nav-wrapper">
    <div class="nav-search">
      <div id="hideable-bar">
        <img src="<?= Yii::$app->request->baseUrl . '/img/accada-logo.png' ?>" alt="" id="logo" />
        <button class="button btn-courses">Courses</button>
      </div>
      <div class="search-bar">
        <input type="text" class="search-field" placeholder="Course name" />
        <button id="open-search" class="button btn-courses">
          <img src="<?= Yii::$app->request->baseUrl . '/img/Search.svg' ?>" alt="" />
          <!-- Search -->
        </button>
      </div>
    </div>
    <nav class="nav-main">
      <ul class="nav-list">
        <li class="nav-list-item">  
          <a href="" class="nav-link">Home</a>
        </li>
        <li class="nav-list-item">
          <a href="" class="nav-link">Contacts</a>
        </li>
        <li class="nav-list-item">
          <a href="" class="nav-link">About us</a>
        </li>
        <li class="nav-list-item">
          <a href="" class="nav-link">Blog </a>
        </li>
      </ul>
    </nav>
  </div>
  <section class="header-ad">
    <div class="magic-bg"></div>
    <div class="snake"></div>
    <!-- <div class="magic-bg">
      <span class="border top"></span>
      <span class="border right"></span>
      <span class="border bottom"></span>
      <span class="border left"></span>
      <h1 class="ad-title">Explore new courses</h1>
      <p class="ad-description">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus
        optio laborum accusamus sapiente aspernatur. Quis beatae libero
        voluptas voluptatem ducimus, nostrum dolorum laboriosam omnis aut
        nesciunt porro asperiores perferendis inventore?
      </p>
      <div class="ad-btn-ctn">
        <button class="button button-login">Login</button>
        <button class="button button-watch">Watch</button>
      </div>
    </div> -->
  </section>
</header>
<!-- <img style="background-color: azure;" src="./img/Essential icons.svg" alt="" srcset=""> -->
<main>
  <section class="top-courses">
    <h2 class="title">Top courses of the month</h2>
    <div class="horizontal-scroll top-courses-content">
      <div class="course">
        <h4 class="course-name">Managment</h4>
      </div>
    </div>
  </section>
  <section class="">
    <h2 class="title big">БОЛЕЕ СОТНИ БЕСПЛАТНЫХ КУРСОВ ДЛЯ ТЕБЯ</h2>
    <div class="wrapper df df-row df-between">
      <div class="desc-block df df-column df-center">
        <h3 class="desc-title white">
          Найдите гибкие и доступные варианты обучения
        </h3>
        <p class="main-text white">
          Выбирайте среди множества вариантов обучения, включая бесплатные
          курсы и высшее образование по выгодной цене. Учитесь в удобном
          темпе, исключительно онлайн.
        </p>
      </div>
      <div class="img-container">
        <img src="" alt="">
      </div>
    </div>
  </section>
</main>