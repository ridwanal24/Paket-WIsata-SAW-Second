<?php
include 'koneksi.php';
// Require composer autoload


if (isset($_POST['content'])) {
  $htmlcode = htmlentities(htmlspecialchars($_POST['content']));
  $query = $koneksi->query("INSERT INTO tb_print_hasil (content) VALUES ('$htmlcode');");
  $query = $koneksi->query(" SELECT LAST_INSERT_ID() as id;");
  while ($row = $query->fetch_assoc()) {
    echo $row['id'];
  }
} else if (isset($_GET['id_cetak'])) {
  require_once 'vendor/autoload.php';
  // Create an instance of the class:
  $mpdf = new \Mpdf\Mpdf();

  $ambil = $koneksi->query("SELECT * FROM tb_print_hasil WHERE id=" . $_GET['id_cetak']);

  $content = '<!DOCTYPE html>
<html>
<head>
  <title>Daftar Paket</title>
  </head>
  <body>

<style>
  .text-center {
    text-align:center;
  }
  table, th, td {
    font-size: 12px;
    border: 1px solid black;
    border-collapse:collapse;
    padding: 8px;
  }
  body {
    background: #fff;
    font-family: "Rubik", arial, sans-serif;
    font-weight: 300;
    font-size: 15px;
    line-height: 1.8;
    color: #6c757d;
  }
  
  a {
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    text-decoration: none;
  }
  
  a:hover {
    text-decoration: none;
  }
  
  h1, h2, h3, h4, h5 {
    color: #000;
    font-family: "Playfair Display", times, serif;
  }
  
  header {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 5;
  }
  
  header .navbar-brand {
    text-transform: uppercase;
    letter-spacing: .2em;
    font-weight: 400;
    color: #fff !important;
  }
  
  header .navbar {
    padding-top: 0;
    padding-bottom: 0;
    background: transparent !important;
  }
  
  @media (max-width: 991.98px) {
    header .navbar {
      background: rgba(0, 0, 0, 0.4) !important;
      padding-top: .5rem;
      padding-bottom: .5rem;
    }
  }
  
  header .navbar .nav-link {
    padding: 1.7rem 1rem;
    outline: none !important;
  }
  
  @media (max-width: 991.98px) {
    header .navbar .nav-link {
      padding: .5rem .5rem;
    }
  }
  
  header .navbar .nav-link:hover {
    color: #fff !important;
  }
  
  header .navbar .nav-link.active {
    color: #fff !important;
  }
  
  header .navbar .cta {
    float: right;
  }
  
  header .navbar .cta > a {
    margin-top: -12px;
    position: relative;
  }
  
  @media (max-width: 767.98px) {
    header .navbar .cta > a {
      margin-top: inherit;
    }
  }
  
  header .navbar .cta > a span {
    display: inline-block;
    padding: 10px 20px;
    border: 2px solid #ccc;
  }
  
  header .navbar .dropdown.show > a {
    color: #fff !important;
  }
  
  header .navbar .dropdown-menu {
    font-size: 14px;
    border-radius: 4px;
    border: none;
    -webkit-box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 30px 0px rgba(0, 0, 0, 0.2);
    min-width: 13em;
    margin-top: -10px;
  }
  
  header .navbar .dropdown-menu:before {
    bottom: 100%;
    left: 10%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-bottom-color: #fff;
    border-width: 10px;
  }
  
  @media (max-width: 1199.98px) {
    header .navbar .dropdown-menu:before {
      display: none;
    }
  }
  
  header .navbar .dropdown-menu .dropdown-item:hover {
    background: #b99365;
    color: #fff;
  }
  
  header .navbar .dropdown-menu .dropdown-item.active {
    background: #b99365;
    color: #fff;
  }
  
  header .navbar .dropdown-menu a {
    padding-top: 7px;
    padding-bottom: 7px;
  }
  
  header .navbar.navbar-light .nav-link {
    color: #fff;
  }
  
  header .navbar.navbar-light .nav-link.active {
    color: #fff;
  }
  
  .site-hero {
    background-size: cover;
    background-position: center center;
    min-height: 750px;
    height: 100vh;
  }
  
  .site-hero > .container {
    position: relative;
    z-index: 2;
  }
  
  .site-hero.overlay {
    position: relative;
  }
  
  .site-hero.overlay:before {
    content: "";
    background: rgba(0, 0, 0, 0.5);
    width: 100%;
    z-index: 1;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
  }
  
  .site-hero.overlay h1, .site-hero.overlay p {
    color: #fff;
  }
  
  .site-hero.overlay h1 {
    font-size: 60px;
  }
  
  @media (max-width: 1199.98px) {
    .site-hero.overlay h1 {
      font-size: 40px;
    }
  }
  
  .site-hero.overlay p {
    font-size: 30px;
  }
  
  @media (max-width: 1199.98px) {
    .site-hero.overlay p {
      font-size: 20px;
    }
  }
  
  .site-hero .site-hero-inner {
    min-height: 750px;
    height: 100vh;
  }
  
  .room {
    background: #fff;
    margin-bottom: 30px;
  }
  
  .room figure {
    position: relative;
    float: left;
    overflow: hidden;
  }
  
  .room figure:after {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #000;
    opacity: .5;
    content: "";
  }
  
  .room figure .overlap-text {
    z-index: 99;
    position: absolute;
    bottom: 20px;
    left: 20px;
    color: #fff;
    text-transform: uppercase;
    font-size: 13px;
  }
  
  .room .media-body {
    padding: 30px;
    border: 1px solid #e6e6e6;
    border-top: none;
  }
  
  .room .media-body .room-specs {
    margin: 0;
    padding: 0;
  }
  
  .room .media-body .room-specs li {
    display: inline-block;
    list-style: none;
    margin: 0;
    padding: 0 20px 20px 0;
  }
  
  .room .media-body .room-specs li span {
    font-size: 30px;
    position: relative;
    top: 4px;
    margin-right: 10px;
  }
  
  .room-thumbnail-absolute {
    position: relative;
  }
  
  .room-thumbnail-absolute .room {
    position: relative;
  }
  
  .room-thumbnail-absolute .room.bg {
    position: relative;
    height: 47.8%;
    width: 100%;
    background-size: cover;
  }
  
  .room-thumbnail-absolute .room.bg:last-child {
    margin-bottom: 0;
  }
  
  .room-thumbnail-absolute .room .pricing-from {
    margin-left: 10px;
    padding: 5px 10px;
    background: #ffc107;
    border-radius: 4px;
    font-size: 13px;
  }
  
  .room-thumbnail-absolute .room:after {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: #000;
    opacity: .5;
    content: "";
  }
  
  .room-thumbnail-absolute .room .overlap-text {
    bottom: 20px;
    left: 20px;
    width: 100%;
    position: absolute;
    z-index: 10;
  }
  
  .room-thumbnail-absolute .room .overlap-text span {
    color: #fff;
    text-transform: uppercase;
    font-size: 13px;
  }
  
  .site-hero-innerpage, .site-hero-innerpage .site-hero-inner {
    min-height: 550px;
    height: 50vh;
  }
  
  .site-section {
    padding: 7em 0;
  }
  
  #search-form .search-input {
    width: calc(100% - 160px);
    height: 55px;
    border-radius: 0;
    padding-left: 20px;
    padding-right: 20px;
    border: none;
  }
  
  #search-form .search-input:hover, #search-form .search-input:active, #search-form .search-input:focus {
    border: none;
  }
  
  #search-form button {
    height: 55px;
    width: 160px;
    border-radius: 0;
  }
  
  .img-bg {
    background-size: cover;
  }
  
  @media (max-width: 767.98px) {
    .img-md-fluid {
      max-width: 100%;
    }
  }
  
  .feature-destination, .slider-wrap {
    position: relative;
    z-index: 10;
    margin-top: -50px;
    margin-bottom: 50px;
  }
  
  .feature-destination .img-bg, .slider-wrap .img-bg {
    margin-bottom: 30px;
    display: block;
    height: 300px;
    position: relative;
    top: 0;
    -webkit-transition: .2s all ease;
    -o-transition: .2s all ease;
    transition: .2s all ease;
  }
  
  .feature-destination .img-bg:before, .slider-wrap .img-bg:before {
    content: "";
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: #000;
    opacity: .1;
    position: absolute;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .feature-destination .img-bg .text, .slider-wrap .img-bg .text {
    position: absolute;
    top: 50%;
    left: 50%;
    text-align: center;
    width: 80%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }
  
  .feature-destination .img-bg .text .icon, .slider-wrap .img-bg .text .icon {
    color: #fff;
    font-size: 30px;
    position: relative;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    top: 0;
  }
  
  .feature-destination .img-bg .text h2, .slider-wrap .img-bg .text h2 {
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    margin: 0;
    padding: 0;
    font-size: 18px;
    font-weight: 400;
    color: #fff;
    top: 0px;
    position: relative;
  }
  
  .feature-destination .img-bg .text p, .slider-wrap .img-bg .text p {
    color: #fff;
    opacity: 0;
    top: 10px;
    visibility: hidden;
    font-size: 13px;
    position: relative;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .feature-destination .img-bg:hover, .feature-destination .img-bg:focus, .slider-wrap .img-bg:hover, .slider-wrap .img-bg:focus {
    top: -10px;
    -webkit-box-shadow: 2px 0 20px 0 rgba(0, 0, 0, 0.4);
    box-shadow: 2px 0 20px 0 rgba(0, 0, 0, 0.4);
  }
  
  .feature-destination .img-bg:hover .text .icon, .feature-destination .img-bg:focus .text .icon, .slider-wrap .img-bg:hover .text .icon, .slider-wrap .img-bg:focus .text .icon {
    top: -10px;
  }
  
  .feature-destination .img-bg:hover .text h2, .feature-destination .img-bg:focus .text h2, .slider-wrap .img-bg:hover .text h2, .slider-wrap .img-bg:focus .text h2 {
    top: -10px;
  }
  
  .feature-destination .img-bg:hover .text p, .feature-destination .img-bg:focus .text p, .slider-wrap .img-bg:hover .text p, .slider-wrap .img-bg:focus .text p {
    top: 0;
    opacity: .5;
    visibility: visible;
  }
  
  .feature-destination .img-bg:hover:before, .feature-destination .img-bg:focus:before, .slider-wrap .img-bg:hover:before, .slider-wrap .img-bg:focus:before {
    opacity: .4;
  }
  
  .slider-wrap {
    margin-top: 0;
  }
  
  .slider-wrap .img-bg:hover {
    top: 0;
  }
  
  .btn-play-wrap .btn-play {
    width: 70px;
    height: 70px;
    line-height: 50px;
    border: 2px solid #fff;
    border-radius: 50%;
    display: inline-block;
    text-align: center;
    position: relative;
  }
  
  .btn-play-wrap .btn-play span {
    position: absolute;
    top: 50%;
    left: 50%;
    font-size: 40px;
    -webkit-transform: translate(-30%, -50%);
    -ms-transform: translate(-30%, -50%);
    transform: translate(-30%, -50%);
    color: #fff;
  }
  
  .section-cover {
    background-size: cover;
    position: relative;
    background-position: top left;
  }
  
  .section-cover, .section-cover .intro {
    height: 500px;
  }
  
  .section-cover p {
    color: #fff;
  }
  
  .section-cover h2 {
    color: #fff;
    font-size: 50px;
  }
  
  .top-destination .place {
    display: block;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .top-destination .place:hover, .top-destination .place:focus {
    opacity: .7;
  }
  
  .top-destination .place img {
    max-width: 100%;
    margin-bottom: 20px;
  }
  
  .top-destination .place h2 {
    font-size: 18px;
    line-height: 1.5;
  }
  
  .top-destination .place p {
    font-size: 13px;
    color: #ccc;
  }
  
  .btn, .form-control {
    outline: none;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border-radius: 0;
  }
  
  .btn:focus, .btn:active, .form-control:focus, .form-control:active {
    outline: none;
  }
  
  .form-control {
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
  }
  
  textarea.form-control {
    height: inherit;
  }
  
  .btn {
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    padding: 12px 30px;
    text-transform: uppercase;
    letter-spacing: .15em;
  }
  
  .btn.btn-black {
    background: #000;
    color: #fff;
  }
  
  .btn.btn-primary {
    color: #fff;
    border-width: 2px;
  }
  
  .btn.btn-primary:hover, .btn.btn-primary:active, .btn.btn-primary:focus {
    border-color: #c9ac88;
    background: #c9ac88;
  }
  
  .btn.btn-sm {
    font-size: 12px;
  }
  
  .btn.btn-outline-primary {
    border-width: 2px;
    color: #b99365;
  }
  
  .btn.btn-outline-primary:hover, .btn.btn-outline-primary:focus, .btn.btn-outline-primary:active {
    color: #fff;
  }
  
  .btn.btn-outline-white {
    border-width: 2px;
    border-color: #fff;
    color: #fff;
  }
  
  .btn.btn-outline-white:hover, .btn.btn-outline-white:focus {
    background: #fff;
    color: #000;
    border-width: 2px;
  }
  
  .btn:hover {
    -webkit-box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
    box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
  }
  
  .custom-icon {
    font-size: 70px;
    color: #b99365;
  }
  
  .no-nav .owl-nav {
    display: none;
  }
  
  .owl-carousel .owl-item {
    opacity: .4;
  }
  
  .owl-carousel .owl-item.active {
    opacity: 1;
  }
  
  .owl-carousel .owl-nav {
    position: absolute;
    top: 50%;
    width: 100%;
  }
  
  .owl-carousel .owl-nav .owl-prev,
  .owl-carousel .owl-nav .owl-next {
    position: absolute;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    margin-top: -10px;
  }
  
  .owl-carousel .owl-nav .owl-prev:hover, .owl-carousel .owl-nav .owl-prev:focus, .owl-carousel .owl-nav .owl-prev:active,
  .owl-carousel .owl-nav .owl-next:hover,
  .owl-carousel .owl-nav .owl-next:focus,
  .owl-carousel .owl-nav .owl-next:active {
    outline: none;
  }
  
  .owl-carousel .owl-nav .owl-prev span:before,
  .owl-carousel .owl-nav .owl-next span:before {
    font-size: 40px;
  }
  
  .owl-carousel .owl-nav .owl-prev {
    left: 30px !important;
  }
  
  .owl-carousel .owl-nav .owl-next {
    right: 30px !important;
  }
  
  .owl-carousel .owl-dots {
    text-align: center;
  }
  
  .owl-carousel .owl-dots .owl-dot {
    width: 10px;
    height: 10px;
    margin: 5px;
    border-radius: 50%;
    background: #e6e6e6;
  }
  
  .owl-carousel .owl-dots .owl-dot.active {
    background: #b99365;
  }
  
  .owl-carousel.home-slider {
    z-index: 1;
    position: relative;
  }
  
  .owl-carousel.home-slider .owl-nav {
    opacity: 0;
    visibility: hidden;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .owl-carousel.home-slider .owl-nav button {
    color: #fff;
  }
  
  .owl-carousel.home-slider:focus .owl-nav, .owl-carousel.home-slider:hover .owl-nav {
    opacity: 1;
    visibility: visible;
  }
  
  .owl-carousel.home-slider .slider-item {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    height: calc(100vh - 117px);
    min-height: 700px;
    position: relative;
  }
  
  .owl-carousel.home-slider .slider-item:before {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.2);
    content: "";
  }
  
  .owl-carousel.home-slider .slider-item .slider-text {
    color: #fff;
    height: calc(100vh - 117px);
    min-height: 700px;
  }
  
  .owl-carousel.home-slider .slider-item .slider-text .child-name {
    font-size: 40px;
    color: #fff;
  }
  
  .owl-carousel.home-slider .slider-item .slider-text h1 {
    font-size: 40px;
    color: #fff;
    line-height: 1.2;
    font-weight: 800 !important;
    text-transform: uppercase;
  }
  
  @media (max-width: 991.98px) {
    .owl-carousel.home-slider .slider-item .slider-text h1 {
      font-size: 40px;
    }
  }
  
  .owl-carousel.home-slider .slider-item .slider-text p {
    font-size: 20px;
    line-height: 1.5;
    font-weight: 300;
    color: white;
  }
  
  .owl-carousel.home-slider .slider-item.dark .child-name {
    color: #000;
  }
  
  .owl-carousel.home-slider .slider-item.dark h1 {
    color: #000;
  }
  
  .owl-carousel.home-slider .slider-item.dark p {
    color: #000;
  }
  
  .owl-carousel.home-slider.inner-page .slider-item {
    height: calc(50vh - 117px);
    min-height: 350px;
  }
  
  .owl-carousel.home-slider.inner-page .slider-item .slider-text {
    color: #fff;
    height: calc(50vh - 117px);
    min-height: 350px;
  }
  
  .owl-carousel.home-slider .owl-dots {
    position: absolute;
    bottom: 100px;
    width: 100%;
  }
  
  .owl-carousel.home-slider .owl-dots .owl-dot {
    width: 10px;
    height: 10px;
    margin: 5px;
    border-radius: 50%;
    border: 2px solid rgba(255, 255, 255, 0.5);
    outline: none !important;
    position: relative;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .owl-carousel.home-slider .owl-dots .owl-dot.active {
    border: 2px solid white;
  }
  
  .owl-carousel.home-slider .owl-dots .owl-dot.active span {
    background: white;
  }
  
  .owl-carousel.major-caousel .owl-stage-outer {
    padding-top: 30px;
    padding-bottom: 30px;
  }
  
  .owl-carousel.major-caousel .owl-nav .owl-prev, .owl-carousel.major-caousel .owl-nav .owl-next {
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    color: #495057;
  }
  
  .owl-carousel.major-caousel .owl-nav .owl-prev:hover, .owl-carousel.major-caousel .owl-nav .owl-prev:focus, .owl-carousel.major-caousel .owl-nav .owl-next:hover, .owl-carousel.major-caousel .owl-nav .owl-next:focus {
    color: #6c757d;
    outline: none;
  }
  
  .owl-carousel.major-caousel .owl-nav .owl-prev.disabled, .owl-carousel.major-caousel .owl-nav .owl-next.disabled {
    color: #dee2e6;
  }
  
  .owl-carousel.major-caousel .owl-nav .owl-prev {
    left: -60px !important;
  }
  
  .owl-carousel.major-caousel .owl-nav .owl-next {
    right: -60px !important;
  }
  
  .owl-carousel.major-caousel .owl-dots {
    bottom: -30px !important;
    position: relative;
  }
  
  .owl-custom-nav {
    float: right;
    position: relative;
    z-index: 10;
  }
  
  .owl-custom-nav .owl-custom-prev,
  .owl-custom-nav .owl-custom-next {
    padding: 10px;
    font-size: 30px;
    background: #ccc;
    line-height: 0;
    width: 60px;
    text-align: center;
    display: inline-block;
  }
  
  .box {
    overflow: hidden;
    border-radius: 4px;
    display: block;
  }
  
  .box img {
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .box .box-body {
    padding: 20px;
    border: 1px solid #e9ecef;
    border-top: none;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .box h2 {
    font-size: 18px;
    font-family: "Rubik", arial, sans-serif;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .box.hover:hover img, .box.hover:focus img {
    margin-top: -20px;
  }
  
  .box.hover:hover .box-body, .box.hover:focus .box-body {
    background: #b99365;
    color: #fff;
    padding: 30px 20px;
    border-color: #b99365;
  }
  
  .box.hover:hover h2, .box.hover:focus h2 {
    color: #fff;
  }
  
  .breadcrumb-custom {
    background: none;
    padding: 0;
  }
  
  .breadcrumb-custom li a {
    color: #b99365;
  }
  
  .breadcrumb-custom li a:hover {
    color: #fff;
  }
  
  .breadcrumb-custom li.active {
    color: #fff;
  }
  
  .breadcrumb-custom li.breadcrumb-item + .breadcrumb-item:before {
    content: "/";
    color: rgba(255, 255, 255, 0.3);
  }
  
  .pagination {
    float: none;
    display: inline-block;
  }
  
  .pagination li {
    display: inline-block;
  }
  
  .post-entry {
    margin-bottom: 30px;
  }
  
  .post-entry .body-text {
    padding: 30px;
    background: #fff;
  }
  
  .post-entry .body-text .category {
    position: relative;
    padding-bottom: 10px;
    margin-bottom: 10px;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: .2em;
    color: #ccc;
  }
  
  .post-entry .body-text .category:after {
    content: "";
    left: 0;
    width: 50px;
    height: 1px;
    background: #000;
    position: absolute;
    bottom: 0;
  }
  
  .children-info li {
    display: block;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 1px dotted #dee2e6;
  }
  
  .sidebar {
    padding-left: 5em;
  }
  
  @media (max-width: 991.98px) {
    .sidebar {
      padding-left: 15px;
    }
  }
  
  .sidebar-box {
    margin-bottom: 4em;
    font-size: 15px;
    width: 100%;
    float: left;
    background: #fff;
  }
  
  .sidebar-box *:last-child {
    margin-bottom: 0;
  }
  
  .sidebar-box .heading {
    font-size: 18px;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e6e6e6;
  }
  
  .tags {
    padding: 0;
    margin: 0;
    font-weight: 400;
  }
  
  .tags li {
    padding: 0;
    margin: 0 4px 4px 0;
    float: left;
    display: inline-block;
  }
  
  .tags li a {
    float: left;
    display: block;
    border-radius: 4px;
    padding: 2px 6px;
    color: gray;
    background: #f2f2f2;
  }
  
  .tags li a:hover {
    color: #fff;
    background: #b99365;
  }
  
  .sidebar-box {
    margin-bottom: 30px;
    padding: 25px;
    font-size: 15px;
    width: 100%;
    border-radius: 7px;
    float: left;
    background: #fff;
  }
  
  .sidebar-box ul li {
    list-style: none;
  }
  
  .sidebar-box *:last-child {
    margin-bottom: 0;
  }
  
  .sidebar-box h3 {
    font-size: 18px;
    margin-bottom: 15px;
  }
  
  .categories, .sidelink {
    padding: 0;
  }
  
  .categories li, .sidelink li {
    position: relative;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px dotted #dee2e6;
  }
  
  .categories li:last-child, .sidelink li:last-child {
    margin-bottom: 0;
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .categories li a, .sidelink li a {
    display: block;
  }
  
  .categories li a span, .sidelink li a span {
    position: absolute;
    right: 0;
    top: 0;
    color: #ccc;
  }
  
  .categories li.active a, .sidelink li.active a {
    color: #000;
    font-style: italic;
  }
  
  .cover_1 {
    background-size: cover;
    background-position: center center;
    padding: 7em 0;
  }
  
  .cover_1 .sub-heading {
    color: rgba(255, 255, 255, 0.7);
    font-size: 22px;
  }
  
  .cover_1 .heading {
    font-size: 50px;
    color: white;
    font-weight: 300;
  }
  
  .heading-wrap .heading {
    font-size: 50px;
    margin-bottom: 30px;
  }
  
  .heading-wrap .sub-heading {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: .1em;
    color: #ccc;
    font-family: "Rubik", arial, sans-serif;
  }
  
  .stretch-section .video {
    display: block;
    position: relative;
    -webkit-box-shadow: 4px 4px 70px -20px rgba(0, 0, 0, 0.5);
    box-shadow: 4px 4px 70px -20px rgba(0, 0, 0, 0.5);
  }
  
  .media-feature {
    padding: 30px;
    -webkit-transition: .2s all ease-out;
    -o-transition: .2s all ease-out;
    transition: .2s all ease-out;
    background: #fff;
    z-index: 1;
    position: relative;
    border-bottom: 10px solid transparent;
    border-radius: 4px;
    font-size: 15px;
  }
  
  .media-feature .icon {
    font-size: 60px;
    color: #b99365;
  }
  
  .media-feature h3 {
    font-size: 16px;
    text-transform: uppercase;
  }
  
  .media-feature:hover, .media-feature:focus {
    -webkit-box-shadow: 0 2px 20px -3px rgba(0, 0, 0, 0.1);
    box-shadow: 0 2px 20px -3px rgba(0, 0, 0, 0.1);
    -webkit-transform: scale(1.05);
    -ms-transform: scale(1.05);
    transform: scale(1.05);
    z-index: 2;
    border-bottom: 10px solid #b99365;
  }
  
  .media-custom {
    background: #fff;
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
    margin-bottom: 30px;
    position: relative;
    top: 0;
  }
  
  .media-custom .meta-post {
    color: #ced4da;
    font-size: 13px;
    text-transform: uppercase;
  }
  
  .media-custom > a {
    position: relative;
    overflow: hidden;
    display: block;
  }
  
  .media-custom .meta-chat {
    color: #ced4da;
  }
  
  .media-custom .meta-chat:hover {
    color: #6c757d;
  }
  
  .media-custom img {
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  .media-custom:focus, .media-custom:hover {
    top: -2px;
    -webkit-box-shadow: 0 2px 40px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 40px 0 rgba(0, 0, 0, 0.2);
  }
  
  .media-custom:focus img, .media-custom:hover img {
    -webkit-transform: scale(1.1);
    -ms-transform: scale(1.1);
    transform: scale(1.1);
  }
  
  .media-custom .media-body {
    padding: 30px;
  }
  
  .media-custom .media-body h3 {
    font-size: 20px;
  }
  
  .media-custom .media-body p:last-child {
    margin-bottom: 0;
  }
  
  #accordion .card {
    font-size: 15px;
    border-color: #dee2e6;
  }
  
  #accordion .card h5 a {
    display: block;
    text-align: left;
    text-decoration: none;
    color: #b99365;
    position: relative;
    -webkit-box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
    box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
    border-radius: 0;
  }
  
  #accordion .card h5 a .icon {
    position: absolute;
    right: 20px;
    top: 50%;
    -webkit-transform: translateY(-50%) rotate(-180deg);
    -ms-transform: translateY(-50%) rotate(-180deg);
    transform: translateY(-50%) rotate(-180deg);
    -webkit-transition: .3s all ease;
    -o-transition: .3s all ease;
    transition: .3s all ease;
  }
  
  #accordion .card h5 a:hover {
    text-decoration: none;
    -webkit-box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
    box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
  }
  
  #accordion .card h5 a.collapsed {
    color: #000;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
  }
  
  #accordion .card h5 a.collapsed .icon {
    right: 20px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  
  #accordion .card h5 a.collapsed:hover {
    text-decoration: none;
    -webkit-box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
    box-shadow: 0 3px 10px -2px rgba(0, 0, 0, 0.2) !important;
  }
  
  #accordion .card .card-body {
    padding-top: 15px;
  }
  
  .media-testimonial img {
    width: 100px;
    border-radius: 50%;
  }
  
  .media-testimonial blockquote p {
    font-size: 20px;
    color: #000;
    font-style: italic;
  }
  
  .list-unstyled.check li {
    position: relative;
    padding-left: 30px;
    line-height: 1.3;
    margin-bottom: 10px;
  }
  
  .list-unstyled.check li:before {
    color: #17a2b8;
    left: 0;
    font-family: "Ionicons";
    content: "\f122";
    position: absolute;
  }
  
  #modalAppointment .modal-content {
    border-radius: 0;
    border: none;
  }
  
  #modalAppointment .modal-body, #modalAppointment .modal-footer {
    padding: 40px;
  }
  
  .site-footer {
    padding: 5em 0;
    background: #f2f2f2;
    font-size: 16px;
  }
  
  .site-footer h3 {
    margin-bottom: 20px;
    font-family: "Rubik", arial, sans-serif;
    font-size: 13px;
    letter-spacing: .2em;
    color: #b3b3b3;
    text-transform: uppercase;
  }
  
  .site-footer .list-unstyled li {
    margin-bottom: 15px;
  }
  
  .site-footer .list-unstyled li h3 {
    font-size: 16px;
    font-weight: normal;
    font-family: "Rubik", arial, sans-serif;
  }
  
  .site-footer p {
    color: #000;
  }
  
  .site-footer p:last-child {
    margin-bottom: 0;
  }
  
  .site-footer a {
    color: #000;
  }
  
  .site-footer a:hover {
    opacity: .4;
  }
  
  .site-footer .footer-link li {
    line-height: 1.5;
    margin-bottom: 15px;
  }
  
  .site-footer hr {
    width: 100%;
  }
  
  .subscribe .form-group {
    position: relative;
  }
  
  .subscribe input[type="email"] {
    padding-right: 40px;
  }
  
  .subscribe button {
    border: none;
    background: none;
    cursor: pointer;
    right: 10px;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    position: absolute;
  }
  
  .subscribe button span {
    font-size: 30px;
  }
  
  .search-form-wrap {
    margin-bottom: 5em;
    display: block;
  }
  
  .search-form .form-group {
    position: relative;
  }
  
  .search-form .form-group #s {
    padding-right: 50px;
    background: #f7f7f7;
    padding: 15px 15px;
    border: none;
  }
  
  .search-form .icon {
    position: absolute;
    top: 50%;
    right: 20px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
  }
  
  .post-entry-sidebar .post-meta {
    font-size: 14px;
    color: #b3b3b3;
  }
  
  .post-entry-sidebar ul {
    padding: 0;
    margin: 0;
  }
  
  .post-entry-sidebar ul li {
    list-style: none;
    padding: 0 0 20px 0;
    margin: 0 0 20px 0;
  }
  
  .post-entry-sidebar ul li a {
    display: table;
  }
  
  .post-entry-sidebar ul li a img {
    width: 90px;
  }
  
  .post-entry-sidebar ul li a img, .post-entry-sidebar ul li a .text {
    display: table-cell;
    vertical-align: middle;
  }
  
  .post-entry-sidebar ul li a .text h4 {
    font-size: 18px;
  }
  
  .comment-form-wrap {
    clear: both;
  }
  
  .comment-list {
    padding: 0;
    margin: 0;
  }
  
  .comment-list .children {
    padding: 50px 0 0 40px;
    margin: 0;
    float: left;
    width: 100%;
  }
  
  .comment-list li {
    padding: 0;
    margin: 0 0 30px 0;
    float: left;
    width: 100%;
    clear: both;
    list-style: none;
  }
  
  .comment-list li .vcard {
    width: 80px;
    float: left;
  }
  
  .comment-list li .vcard img {
    width: 50px;
    border-radius: 50%;
  }
  
  .comment-list li .comment-body {
    float: right;
    width: calc(100% - 80px);
  }
  
  .comment-list li .comment-body h3 {
    font-size: 20px;
  }
  
  .comment-list li .comment-body .meta {
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: .1em;
    color: #ccc;
  }
  
  .comment-list li .comment-body .reply {
    padding: 5px 10px;
    background: #e6e6e6;
    color: #000;
    text-transform: uppercase;
    font-size: 14px;
  }
  
  .comment-list li .comment-body .reply:hover {
    color: #000;
    background: #e3e3e3;
  }
  
  .blog-entry-footer .post-meta {
    color: gray;
    font-size: 15px;
  }
  
  .border-t {
    border-top: 1px solid #f8f9fa;
  }
  
  .copyright {
    font-size: 14px;
  }
  
  .element-animate {
    opacity: 0;
    visibility: hidden;
  }
  
  #loader {
    position: fixed;
    width: 96px;
    height: 96px;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.9);
    -webkit-box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
    box-shadow: 0px 24px 64px rgba(0, 0, 0, 0.24);
    border-radius: 16px;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: opacity .2s ease-out, visibility 0s linear .2s;
    -o-transition: opacity .2s ease-out, visibility 0s linear .2s;
    transition: opacity .2s ease-out, visibility 0s linear .2s;
    z-index: 1000;
  }
  
  #loader.fullscreen {
    padding: 0;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    -webkit-transform: none;
    -ms-transform: none;
    transform: none;
    background-color: #fff;
    border-radius: 0;
    -webkit-box-shadow: none;
    box-shadow: none;
  }
  
  #loader.show {
    -webkit-transition: opacity .4s ease-out, visibility 0s linear 0s;
    -o-transition: opacity .4s ease-out, visibility 0s linear 0s;
    transition: opacity .4s ease-out, visibility 0s linear 0s;
    visibility: visible;
    opacity: 1;
  }
  
  #loader .circular {
    -webkit-animation: loader-rotate 2s linear infinite;
    animation: loader-rotate 2s linear infinite;
    position: absolute;
    left: calc(50% - 24px);
    top: calc(50% - 24px);
    display: block;
    -webkit-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  
  #loader .path {
    stroke-dasharray: 1, 200;
    stroke-dashoffset: 0;
    -webkit-animation: loader-dash 1.5s ease-in-out infinite;
    animation: loader-dash 1.5s ease-in-out infinite;
    stroke-linecap: round;
  }
  
  @-webkit-keyframes loader-rotate {
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  
  @keyframes loader-rotate {
    100% {
      -webkit-transform: rotate(360deg);
      transform: rotate(360deg);
    }
  }
  
  @-webkit-keyframes loader-dash {
    0% {
      stroke-dasharray: 1, 200;
      stroke-dashoffset: 0;
    }
    50% {
      stroke-dasharray: 89, 200;
      stroke-dashoffset: -35px;
    }
    100% {
      stroke-dasharray: 89, 200;
      stroke-dashoffset: -136px;
    }
  }
  
  @keyframes loader-dash {
    0% {
      stroke-dasharray: 1, 200;
      stroke-dashoffset: 0;
    }
    50% {
      stroke-dasharray: 89, 200;
      stroke-dashoffset: -35px;
    }
    100% {
      stroke-dasharray: 89, 200;
      stroke-dashoffset: -136px;
    }
  }

  .reset {
    padding: 0;
    margin: 0;
  }

  </style>

  <!-- <img src="images/logo.png" style="float: left; height: 90px">

  <div style="margin-left: 20px">
    <strong>Daftar Paket</strong><br>
    PO. Tami Jaya<br>
    Alamat: JL. RE. Martadinata No. 84 Yogyakarta <br>
    <div style="font-size:12px">
      Telepon: (0274) 618080 / 586742
      Handphone: 0811 250 136
      Email: po.tamijaya@rocketmail.com
    </div>
  </div> 

  <hr style="border: 0.5px solid black; margin: 10px 5px 10px 5px;">
-->
  <div style="font-size: 11px; margin-left: 10px; margin-bottom: -40px; margin-top: -20px;">&nbsp; Tanggal CETAK: ' . date("d-m-Y") . '</div> <br>
';

  while ($pecah = $ambil->fetch_assoc()) {
    $content .= html_entity_decode(htmlspecialchars_decode($pecah['content']));
  }

  $content .= '
</body>
</html>';

  // Write some HTML code:
  $mpdf->WriteHTML($content);

  // Output a PDF file directly to the browser
  $mpdf->Output("cetakpaket.pdf", "I");
  $koneksi->query("DELETE FROM tb_print_hasil WHERE id=" . $_GET['id_cetak']);
}
