<?php session_start(); ?>
<!doctype html>
<html>
<head>

    <title>Procedimiento: Abuso sexual</title>

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
            <a href="./abuso_proc_form.php" id="previous" style="text-align:left;">&#8249;</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abuso sexual
            </p>

            <?php $current_page = './abuso_proc_handling.php';
                require './includes/topnav.php'; ?>
        </div>
    
        <!-- Texto -->
    
        <div class="body_text">

            <h3>Procedimiento</h3>
            <br>

            <!-- Alimentando $proc_array -->

            <?php
            // isset() useful sometimes (not now).

            $proc_array = array();
            
            if($_POST["temporalidad"][0] == "Yes")
            {
                $text = file_get_contents("instrucciones/72-dias-menos.txt");
                array_push($proc_array, $text);
                // array_push appends $text in $proc_array
            }
            else
            {
                if($_POST["temporalidad"][0] == "No")
                {
                    $text = file_get_contents("instrucciones/72-dias-mas.txt");
                    array_push($proc_array, $text);
                }
                else
                {
                    $text = file_get_contents("instrucciones/72-dias-incierto.txt");
                    array_push($proc_array, $text);
                }
            }

            if($_POST["entorno"][0] == "Yes")
            {
                $text = file_get_contents("instrucciones/entorno-familiar-si.txt");
                array_push($proc_array, $text);
            }
            else
            {
                if($_POST["entorno"][0] == "No")
                {
                    $text = file_get_contents("instrucciones/entorno-familiar-no.txt");
                    array_push($proc_array, $text);
                }
                else
                {
                    $text = file_get_contents("instrucciones/entorno-familiar-incierto.txt");
                    array_push($proc_array, $text);
                }
            }

            // Visualización de $proc_array

            $i = 1;
            while($i <= count($proc_array))
            {
                echo $i . ") " . $proc_array[$i-1] . "<br><br>";
                $i++;
            }
            ?>
        </div>
    </ul>
</div>

<!-- Keep order of script file calls -->

<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
