<?php session_start(); ?>
<!doctype html>
<html>
  <head>

    <title>Menú principal</title>

    <!--
    https://codepen.io/fainder/pen/AydHJ
     -->
    
    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css"
    href="./styles/main.css">

</head>

<body>

<!-- Simulate a smartphone / tablet -->

<div class="mobile-container">
    
    <ul id="accordion" class="accordion">
    
        <!-- Top Navigation -->
            
        <div class="topnav">
            <p class="active" style="text-align:right;">Menú principal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

            <?php $current_page = './index.php';
                  require './includes/topnav.php'?>
        </div>
    
    <!-- Menú tipo acordeón -->
    
    <li>
      <div class="link">
        <a href="./sub_index_abuso.php">Abuso sexual</a>
      </div>
    </li>
    <li>
        <div class="link">
            <a href="#">Acoso escolar</a>
        </div>
    </li>
    <li>
      <div class="link">Consumo</div>
        <ul class="submenu">
          <li><a href="#">Psicoactivos</a></li>
          <li><a href="#">Estupefacientes</a></li>
        </ul>
    </li>
    <li>
    <div class="link">Porte</div>
    <ul class="submenu">
      <li><a href="#">Armas blancas</a></li>
      <li><a href="#">Armas de fuego</a></li>
      <li><a href="#">Drogas ilícitas</a></li>
    </ul>
    </li>
    <li>
    <div class="link">Microtráfico</div>
    <ul class="submenu">
      <li><a href="#">Marijuana</a></li>
    </ul>
    </li>
</ul>

<!-- Keep order of script calls -->

<!--
 online: "http://code.jquery.com/jquery-1.11.1.min.js"

jquery-1.11.1.min.js: only for accordion effect.
-->

<script src="./scripts/jquery-1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
