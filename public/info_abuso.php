<?php session_start(); ?>
<!doctype html>
<html>
<head>

    <title>Información general: Abuso sexual</title>

    <!--
    https://codepen.io/fainder/pen/AydHJ
     -->

    <meta charset="utf-8">
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="./styles/main.css">

</head>

<body>

<!-- Simulate a smartphone / tablet -->

<div class="mobile-container">
    
    <ul class="accordion">

        <!-- Top Navigation -->

        <div class="topnav">
            <p class="active">
            <a href="./sub_index_abuso.php" id="previous" style="text-align:left;">&#8249;
            </a>
            </p>

            <?php $current_page = './info_abuso.php';
                require './includes/topnav.php'; ?>
        </div>
    
        <div class="body_text">
    
            <h3><i>Abuso sexual</i></h3>
            <br>

            <p>Forma de violencia sexual que constituye un delito en Colombia (<a href="https://www.funcionpublica.gov.co/eva/gestornormativo/norma.php?i=31612" target="_blank"><b><u>Ley 1236 de 2008, Capítulo II</b></u></a>).  Algunas de sus características son:</p><br>

                    <ol style="padding-left:15px;">
                        <li style="padding-bottom:10px;">Se utiliza o participa en una actividad sexual, un menor de 14 años, o cualquier persona que no tiene la capacidad mental requerida para:
                            <ul>
                                <li style="padding-bottom:10px;padding-top:10px;">&#8226; Comprender que la actividad sexual en la que participa es inapropiada.</li>
                                <li style="padding-bottom:10px;">&#8226; Anticipar todas las posibles consecuencias que tendrá dicha actividad.</li>
                                <li>&#8226; Decidir libremente si participa o no en dicha actividad.</li>
                            </ul>
                        </li>
                        <li style="padding-bottom:10px;">Se utiliza o participa un niño, niña o adolescente en una actividad que sólo tiene como fin la estimulación, la excitación o la satisfacción sexual de una persona que tiene más:
                            <ul>
                                <li style="padding-bottom:10px;padding-top:10px;">&#8226; edad (3 o más años)</li>
                                <li style="padding-bottom:10px;">&#8226; fuerza</li>
                                <li style="padding-bottom:10px;">&#8226; madurez sexual, tanto física como psicológica y social</li>
                                <li style="padding-bottom:10px;">&#8226; poder o autoridad</li>
                                <li style="padding-bottom:10px;">&#8226; experiencia, información o conocimiento sobre lo que está ocurriendo y sus consecuencias.</li>
                            </ul>
                        </li>
                    </ol>
                    <h4> Referencias</h4>
                    <br>
                    <ul>
            <li> <a href="http://redpapaz.org/prasi/index.php/que-es/que-es-el-abuso-sexual" target="_blank"> <em><u>Red Papaz</em>: ¿Qué es el abuso sexual?</u></a></li>
                    </ul>
        </div>
    </ul>
</div>

<!-- Keep order of script file calls -->

<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
