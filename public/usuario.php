<?php session_start(); ?>
<!doctype html>
<html>
<head>

    <title>Perfil de usuario</title>

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
            <p class="active">
            <a href="./index.php" id="previous" style="text-align:left;">&#8249;
            </a>
            </p>

            <?php $current_page = './usuario.php';
                require './includes/topnav.php'; ?>
        </div>
    
    <!-- Menú tipo acordeón -->
    
        <li>
        <div class="link">
        <a href="#">Actualizar mis datos</a>
<!-- OPCIÓN CUESTIONABLE -->
        </div>
        </li>
        <li>
        <div class="link">
        <a href="#">Cambiar mi clave</a>
<!-- REQUIERE CLAVE TEMPORAL ENVIADA AL CELULAR -->
        </div>
        </li>
    </ul>

<!-- Keep order of script file calls -->

<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
