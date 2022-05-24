<?php session_start(); date_default_timezone_set( "America/Bogota" ) ?>
<!doctype html>
<html>
<head>

    <title>Confirmar</title>

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
            <a href="./sub_index_abuso.php" id="previous" style="text-align:left;">&#8249;</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abuso sexual
            </p>

            <?php $current_page = './abuso_repo_confirm.php';
                require './includes/topnav.php'; ?>
        </div>
    
    <!-- Texto -->
    
        <div class="body_text">


            <?php
                
                /* TO DO: Si estudiante "En transito" no verificar.
                   Si pertenece a IE, proceder con el resto del código...*/
                
                /* BEGIN: Donwload student's profile */
                $db = new SQLite3('./base_datos.db');
                if ($_POST['doc_type'] == "CM")
                {
                    //$doc_type = "matricula";
                    $stmt = $db->prepare('SELECT NUIP, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nac, gen FROM estudiantes WHERE matricula=:dnum;');
                }
                else
                {
                    //$doc_type = "NUIP";
                    $stmt = $db->prepare('SELECT NUIP, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, fecha_nac, gen FROM estudiantes WHERE NUIP=:dnum;');
                }
                
                $stmt->bindValue(':dnum', $_POST['doc_num']);
                $result = $stmt->execute();
                $res = $result->fetchArray(SQLITE3_ASSOC);
                $db->close();
              
                if(isset($res)){
                    echo "<p>Persona no registrada en Institución Educativa:</p><br>";
                    echo $_SESSION['iiee_nombre'][$_POST['IE']];
                    echo "<p>Cancelar reporte o regresar a formulario.</p>";
                    exit();
                }
                echo "<p>Confirmar identificación de la presunta víctima.</p><br><p><b>Nombre:</b>" . $res['primer_nombre'] . " " . $res['segundo_nombre'] . " " . $res['primer_apellido'] . " " . $res['segundo_apellido'] . "</p>";
                echo "<p><br></p><p><b>Edad: </b>" . (date("Y") - substr($res['fecha_nac'], 0, 4)) . " años.</p><br>";

                if ($res['gen'] == "F")
                {
                    echo "<p><b>Género: Femenino</p>";
                }
                else
                {
                    echo "<p><b>Género: Masculino</p>";
                }
            ?>

            <!-- TO DO: AGREGAR COLEGIO AL QUE PERTENECE -->
            <form id="myform" action="./abuso_repo_handling.php" method="POST">
                <input type="hidden" name="NUIP_vic" value=<?php echo $res['NUIP'] ?>>
                <input type="hidden" name="entorno" value=<?php echo $_POST['entorno'] ?>>
                <input type="hidden" name="temporalidad" value=<?php echo $_POST['temporalidad']?>>
                <input type="hidden" name="obs" value=<?php echo $_POST['obs']?>>
                <br>
                <input style="padding:5px" type="submit" value="Confirmar">
                <input style="padding:5px" type="reset" onclick="window.location='index.php';" value="Cancelar">
            </form>

        </div>
    </ul>
</div>

<!-- Keep order of script file calls -->

<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
