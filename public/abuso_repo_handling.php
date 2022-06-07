<?php session_start(); ?>
<!doctype html>
<html>
    <head>
        <title>Reportado abuso sexual</title>
        <!-- https://codepen.io/fainder/pen/AydHJ -->
        <meta charset="utf-8">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="./main.css">
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
                <div class="body_text">
                    <?php
                        function insert_repo() {
                            // mySQL Connect
                            require '../config/config.php'; // values of $servername, $dbname, $dbuser, $dbpass
                            try {
                                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
                                // set the PDO error mode to exception
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                // SQL Query
                                // columns with spacings: https://www.tutorialspoint.com/how-to-select-a-column-name-with-spaces-in-mysql
                                // utf8_decode() to handle tildes and ñ in columns' names
                                $stmt = $conn->prepare(utf8_decode('INSERT INTO abusos (`id (usuario)`, `NUIP (presunta víctima)`, `Edad (presunta víctima)`, `Entorno familiar`, Temporalidad, Observaciones) VALUES (:user_id, :nuip, :edad, :entorno, :tempo, :obs)'));
                                /* Cuestiones como genero de la presunta víctima deben
                                deducirse de tabla de datos con perfil de la presunta víctima.
                     
                                El NUIP (Número Único de Identificación Personal), que es igual para la tarjeta de identidad y la cedula, 
                                se empezó a expedir a partir del 2004.  Entre 2000 y 2003 el NUIP erá alfanumérico pero a estas personas 
                                se les ha reasignado un nuevo NUIP de formato numérico.  Antes del 2000, los número de identificación 
                                requerían especificar si se trataba de número de cédula o tarjeta de identidad.*/
                                $stmt->bindValue(':user_id', $_SESSION['user_id']);
                                $stmt->bindValue(':nuip', $_POST['NUIP_v']);
                                $stmt->bindValue(':edad', $_POST['edad_v']);
                                $stmt->bindValue(':entorno', $_POST['entorno']);
                                $stmt->bindValue(':tempo', $_POST['temporalidad']);
                                $stmt->bindValue(':obs', $_POST['obs']);
                                /* Commented out (revictimiza)
                                $stmt->bindValue(':rel_agr', $_POST['rel_agr']);
                                Commented out (already in student profile)
                                $stmt->bindValue(':IE', $_POST['IE']);*/
                                $stmt->execute();
                                return true;
                            } catch(PDOException $e) {
                            echo "Error: " . "<br>" . $e->getMessage();
                            }
                            $conn = null;
                        }
                        
                        /* You may want to add a conditional on whether the student is registered or not. 
                        If not register, exit() to stop executing php.
                 
                        You may want to ask to confirm data, showing the complete report (including student profile) 
                        and ask option of a pdf copy (with a unique registration number alias RADICADO) after pressing the confirm button. 
                 
                        If you ask for school and grade before filling form, you can create a list of names that will guide you 
                        to choose the right name or id number of the presu victim. */
                        if(insert_repo()){
                            echo "<h3>Reportado!</h3>";
                        };
                        // header('location:./index.php');
                    ?>
                    <!-- <h3>Reportado!</h3><br> -->
                    <br><br><p>Regresar al <a href="./index.php" id="previous2"><u>menú principal</u>.</a></p>
                </div>
            </ul>
        </div>
        <!-- Keep order of script file calls -->
        <script type="text/javascript" src="./scripts/MyScripts.js"></script>
    </body>
</html>
