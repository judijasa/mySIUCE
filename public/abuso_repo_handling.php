<?php session_start(); ?>
<!doctype html>
<html>
<head>

<title>Reportado abuso sexual</title>

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
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abuso sexual
                </p>

            <?php $current_page = './abuso_repo_handling.php';
                require './includes/topnav.php'; ?>
        </div>

            <!-- Texto -->

            <div class="body_text">

                <?php
                    
                    // FUNCTIONS
                    
                function insert_repo()
                {

                    $db = new SQLite3('./base_datos.db');
                    $statement = $db->prepare('INSERT INTO abusos (usuario_id, NUIP_vic, entorno, temporalidad,observ) VALUES (:usuario_id, :NUIP_vic, :entorno, :temporalidad, :obs);');
                    
                    
                    /* Cuestiones como genero de la presunta víctima deben
                     deducirse de tabla de datos con perfil de la presunta víctima.
                     
                     El NUIP (Número Único de Identificación Personal), que es igual para la tarjeta de identidad y la cedula, se empezó a expedir a partir del 2004.  Entre 2000 y 2003 el NUIP erá alfanumérico pero a estas personas se les ha reasignado
                         un nuevo NUIP de formato numérico.  Antes del 2000, los número de identificación requerían especificar si se trataba de número de cédula o tarjeta de identidad.
                     */
                    $statement->bindValue(':usuario_id', $_SESSION['usr_id']);
                    $statement->bindValue(':NUIP_vic', $_POST['NUIP_vic']);
                    $statement->bindValue(':entorno', $_POST['entorno']);
                    $statement->bindValue(':temporalidad', $_POST['temporalidad']);
                    $statement->bindValue(':obs', $_POST['obs']);
                    
                    /* Commented out: revictimiza
                    $statement->bindValue(':rel_agr', $_POST['rel_agr']);
                    */
                    /* Commented out: already in student profile
                    $statement->bindValue(':IE', $_POST['IE']);
                    */
                    
                    $result = $statement->execute();
                    
                }

                        // COMMANDS
                /*
                You may want to add a conditional on whether the student is registered or not. If not register, exit() to stop executing php.
                 
                 You may want to ask to confirm data, showing the complete report (including student profile) and ask option of a pdf copy (with a unique registration number alias RADICADO) after pressing the confirm button. 
                 
                 If you ask for school and grade before filling form, you can create a list of names that will guide you to choose the right name or id number of the presu victim.
                 */
                    insert_repo();
                    
                    // header('location:./index.php');
                ?>
                    <h3>Reportado!</h3><br>
                    Regresar al <a href="./index.php" id="previous2"><u>menú principal</u>.</a>
            </div>
            </ul>
        </div>

        <!-- Keep order of script file calls -->

        <script type="text/javascript" src="./scripts/MyScripts.js"></script>

    </body>
</html>
