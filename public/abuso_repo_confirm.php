<?php session_start(); 
date_default_timezone_set( "America/Bogota" );
?>

<!doctype html>
<html>
    <head>
        <title>Confirmar</title>
        <!-- https://codepen.io/fainder/pen/AydHJ -->
        <!-- http://blog.fidelizador.com/2019/12/17/utf8-n-tildes-y-caracteres-especiales/ -->
        <!-- "Frente al dilema de qué tipo de codificación utilizar en la programación de un sitio web o diseño de email, 
              recomendamos que elijas hacerlo únicamente en UTF-8." -->
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <!-- En html "utf-8", "ISO-8859-1" es equivalente a utf8 y latin1 en mySQL --> <!-- visualiza tilde y ñ -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" type="text/css" href="./styles/main.css">
    </head>
<body>

<?php $current_page = './abuso_repo_form.php';?>

<!-- Simulate a smartphone / tablet -->

<div class="mobile-container">
    
    <ul id="accordion" class="accordion">

        <!-- Top Navigation -->

        <div class="topnav">
            <p class="active">
            <a href="abuso_repo_form.php" id="previous" style="text-align:left;">&#8249;</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abuso sexual
            </p>
            <?php // keep this call here otherwise problems arise
                require './includes/topnav.php';
            ?>
        </div>
    
    <!-- Texto -->
    
        <div class="body_text">

            <?php

                function calc_age($DOB) { // DOB = Date of Birth
                    $date = new DateTime($DOB);
                    $now = new DateTime();
                    $interval = $now->diff($date);
                    return $interval->y; // date format: y-mm-dd.  The line (2001-09-24)->y renders 2001.
                }

                // mySQL Connect
                require 'config/config.php'; // values of $servername, $dbname, $dbuser, $dbpass
                try {
                 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
                 // set the PDO error mode to exception
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                 // SQL Query
                $stmt = $conn->prepare('SELECT primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nac, gen, IE FROM estudiantes WHERE NUIP=:dnum');
                $stmt->bindValue(':dnum', $_POST['doc_num']);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                //echo "Connected successfully";
                } catch(PDOException $e) {
                    echo "Error: " . "<br>" . $e->getMessage();
                }
                $conn = null;
                
                $student['primer_nombre']=$result['primer_nombre'];
                $student['segundo_nombre']=$result['segundo_nombre'];
                $student['primer_apellido']=$result['primer_apellido'];
                $student['segundo_apellido']=$result['segundo_apellido'];
                $student['fecha_nac']=$result['fecha_nac'];
                $student['IE']=$result['IE'];
                
                header('Content-Type: text/html; charset=ISO-8859-1'); // utf-8, ISO-8859-1, utf-8_spanish_ci
                echo "<p>Confirmar identidad de la presunta v&iacute;ctima:</p>";
                echo "<br><p><b>Primer nombre: </b>" . $student['primer_nombre'] . "</p>"; 
                echo "<br><p><b>Segundo nombre: </b>" . $student['segundo_nombre'] . "</p>"; //utf8_decode() 
                echo "<br><p><b>Primer apellido: </b>" . $student['primer_apellido'] . "</p>"; 
                echo "<br><p><b>Segundo apellido: </b>" . $student['segundo_apellido'] . "</p>";
                //$edad_v=(date("Y") - substr($student['fecha_nac'], 0, 4)); //refine to account month and day of birth
                $edad_v = calc_age($student['fecha_nac']);
                echo "<br><p><b>Edad: </b>" . $edad_v . " a&ntilde;os</p>";

                if ($result['gen'] == "F"){
                    echo "<br><p><b>G&eacute;nero:</b> Femenino</p>";
                }
                else
                {
                    echo "<br><p><b>G&eacute;nero:</b> Masculino</p>";
                }
                   // mySQL Connect (downloads all iiee)
                /*try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
                    // mySQL Query
                    $stmt = $conn->prepare('SELECT nombre FROM iiee');
                    $stmt->execute();
     
                    $inst['name'] = array();
                    $i = 0;
                    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ //setFetchMode() not working
                        if(!isset($result['nombre'])) continue;
                        $inst['name'][$i] = $result['nombre'];
                        $i++;
                    }*/

                   // mySQL Connect
                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
                     // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                    // mySQL Query
                    $stmt = $conn->prepare('SELECT nombre FROM iiee WHERE id=:id_var');
                    $stmt->bindValue(':id_var', $student['IE']);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                } catch(PDOException $e) {
                   echo "Error: " . "<br>" . $e->getMessage();
                }
                $conn = null;
                
                $inst['name']=$result['nombre'];
                echo "<br><p><b>Instituci&oacute;n Educativa:</b></p>";
                echo $inst['name'];
            ?>
            
            <!-- Se envian de nuevo los datos del reporte, esta vez de forma definitiva -->
            <form id="myform" action="./abuso_repo_handling.php" method="POST">
                <input type="hidden" name="NUIP_v" value=<?php echo $_POST['doc_num'] ?>>
                <input type="hidden" name="edad_v" value=<?php echo $edad_v ?>>
                <input type="hidden" name="entorno" value=<?php echo $_POST['entorno'] ?>>
                <input type="hidden" name="temporalidad" value=<?php echo $_POST['temporalidad']?>>
                <input type="hidden" name="obs" value=<?php echo "'". utf8_decode($_POST['obs']). "'";?>>
                <!-- Without concatenation with "'", only first string is saved in db. And utf8 is to handle tilde and ñ -->
                <br>
                <div class="okcancel">
                <input type="submit" class="form_submit_button" value="Confirmar"> <!-- style="padding:5px" -->
                <input type="reset" class="form_reset_button" onclick="window.location='index.php';" value="Cancelar">
                </div>
            </form>
        </div>
    </ul>
</div>

<!-- Keep order of script file calls (before </body>) -->
<script type="text/javascript" src="./scripts/MyScripts.js"></script>
</body>
</html>
