<?php session_start(); ?>
<!doctype html>
<html>
<head>

    <title>Abuso sexual</title>

    <!--
    https://codepen.io/fainder/pen/AydHJ
     -->

    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" type="text/css"
        href="./main.css">
        
</head>

<body>

<!-- Simulate a smartphone / tablet -->

<div class="mobile-container">
    
    <ul id="accordion" class="accordion">
    
    <!-- Top Navigation -->
    
        <div class="topnav">
            <p class="active">
            <a href="./index.php" id="previous" style="text-align:left;">&#8249;</a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Abuso sexual
            </p>

            <?php $current_page = './sub_index_abuso.php';
                require './includes/topnav.php'; ?>
        </div>
                
    
    <!-- Menú vertical -->

    <!-- sub-menú horizontal -->
    
    <!--
    <li style="background-image:linear-gradient(#1287A2,#0A3D61);">
        <h4 style="text-align:right;padding-left:15px;padding-top:15px;padding-bottom:15px;color:white;border-color:gray;">Abuso sexual</h4>
    </li>
     -->
    <li>
        <div class="link">
            <a href="./info_abuso.php">Información general</a>
        </div>
    </li>
    <li>
        <div class="link">
            <a href="./abuso_proc_form.php">
                Ver procedimento</a>
        </div>
    </li>
    <?php
        if (! empty($_SESSION['logged_in']))
        {
    ?>
    <li>
        <div class="link">
        <a href="./abuso_repo_form.php">
        Reportar caso</a>
        </div>
    </li>
        <?php
        } else {
        ?>
            <div class="body_text">
            <p><i>&nbsp;&nbsp;<sup>&#42;</sup>Iniciar sesión para reportar casos</i></p>
            </div>
        <?php
        }
        ?>
</ul>

<!-- Keep order of script file calls -->

<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
