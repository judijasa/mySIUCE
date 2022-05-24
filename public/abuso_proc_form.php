<?php session_start(); ?>
<!doctype html>
<html>
<head>

    <title>Formulario: Abuso sexual</title>

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
            <a href="./sub_index_abuso.php" id="previous" style="text-align:left;">&#8249;</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abuso sexual
            </p>

            <?php $current_page = './abuso_proc_form.php';
                require './includes/topnav.php'; ?>
        </div>
    
    <!-- Texto -->
    
        <div class="body_text">

            <p> Para generar el procedimiento, responda a las siguientes preguntas:</p><br>

            <form action="./abuso_proc_handling.php" method="post" class="formulario">
            <!-- Suffix [] indicates values will be handled as an array -->
            <label for="temporalidad[]"> 1) ¿Ocurrió en las últimas 72 horas?</label><br><br>
            <input type="radio" name="temporalidad[]" value="Yes" required>
            Sí<br><br>
            <input type="radio" name="temporalidad[]" value="No" required>
            No<br><br>
            <input type="radio" name="temporalidad[]" required>
            Incierto<br><br>

            <label for="entorno[]"> 2) ¿El presunto agresor hace parte del entorno familiar?</label><br><br>

            <input type="radio" name="entorno[]" value="Yes" required>
            Sí<br><br>
            <input type="radio" name="entorno[]" value="No" required>
            No<br><br>
            <input type="radio" name="entorno[]" required>
            Incierto<br><br>

            <input style="padding:5px" type="submit" value="Enviar">
            </form>
        </div>
    </ul>
</div>

<!-- Keep order of script file calls -->

<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
