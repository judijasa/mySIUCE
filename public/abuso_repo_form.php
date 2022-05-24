<?php session_start();?>
<!doctype html>
<html>
    <head>

        <title>Formulario: Abuso sexual</title>

        <!-- https://codepen.io/fainder/pen/AydHJ
     -->

    <meta charset="utf-8">  <!-- charset="utf-8" -->
    <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="./styles/main.css">
    <!-- 
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"> (not working. Using utf8_encode()...)
    -->

    <!--*****************************************************-->
    <!-- CSS Bootstrap for mobile styling of input form -->
    <!--*****************************************************-->
    <!-- Optional link: 
    https://getbootstrap.com/docs/5.0/forms/form-control/ 
    https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_form_basic&stacked=h 
    -->
    <!-- It improves user experience while filling forms in mobile devices. 
         Among other features it adjusts the styling of input fields.-->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    

<!--*****************************************************-->
<!--** To handle long strings in select option **-->
<!--*****************************************************-->
<!-- Required links:
         http://gregfranko.com/jquery.selectBoxIt.js/#GettingStarted -->
        
        <link type="text/css" rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
        <link type="text/css" rel="stylesheet" href="http://gregfranko.com/jquery.selectBoxIt.js/css/jquery.selectBoxIt.css" />
</head>

<body>
    <?php $current_page = './abuso_repo_form.php';?>

    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">
        <ul id="accordion" class="accordion">

            <!-- Top Navigation -->

            <div class="topnav">
                <p class="active">
                <a href="./sub_index_abuso.php" id="previous" style="text-align:left;">&#8249;</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abuso sexual
                </p>
                <?php // keep this call here otherwise problems arise
                    require './includes/topnav.php';
                ?>
            </div>

            <!-- Texto -->

            <div class="body_text">

                <p> Para reportar, favor responda a las siguientes preguntas:</p><br>

                <form action="abuso_repo_confirm.php" method="POST" class="formulario" id="id_reporte_abuso" accept-charset="UTF-8" onsubmit="return validateForm()">
                    <fieldset form="reporte_abuso">
                    <legend>Presunta víctima:</legend>
                    <p>Primer nombre:</p>
                    <input type="text" name="1er_nombre" value="" class="my-form-control"><br><br>
                    <p>Segundo nombre:</p>
                    <input type="text" name="2do_nombre" value="" class="my-form-control"><br><br>
                    <p>Primer apellido:</p>
                    <input type="text" name="1er_apellido" value="" class="my-form-control"><br><br>
                    <p>Segundo apellido:</p>
                    <input type="text" name="2do_apellido" value="" class="my-form-control"><br><br>
                    <p>Tipo de identificación*:</p>
                    <select name="doc_type" required>
                    <option disabled selected value> -- eliga una opción -- </option>
                    <option value="CM">Código de matrícula</option>
                    <option value="TI">Tarjeta de identidad</option>
                    <option value="CC">Cédula de ciudadanía</option>
                    </select>
                    <br><br><p>Nr. de identificación*:</p>
                    <input type="text" name="doc_num" maxlength="10" value="" placeholder="10 dígitos" class="my-form-control" required><br>
                    </fieldset>
                    <p><br><br></p>
                    <!-- Suffix [] indicates values will be handled as an array -->

                    <label for="temporalidad"> 1) ¿Ocurrió en las últimas 72 horas?</label><br><br>
                    <input type="radio" name="temporalidad" value="72+" required>
                    Sí<br><br>
                    <input type="radio" name="temporalidad" value="72-" required>
                    No<br><br>
                    <input type="radio" name="temporalidad" required>
                    Incierto<br><br>

                    <!-- Definir entorno familiar (e.g. popup window), más que saber si el presu agresor es pariente, es preciso saber si vive con la presu victima o visita su casa regularmente. Si no hace parte del entorno familiar, es muy importante saber si hace parte del colegio al que pertenece la presu victima o algun espacio al que la presu victima visita regularmente (iglesia, etc.)-->

                    <label for="entorno"> 2) ¿El presunto agresor hace parte del entorno familiar?</label><br><br>

                    <input type="radio" name="entorno" value="SI" required>
                    Sí<br><br>
                    <input type="radio" name="entorno" value="NO" required>
                    No<br><br>
                    <input type="radio" name="entorno" value="INCIERTO" required>
                    Incierto<br><br>

                    <p>3) Observaciones:<br><br></p>
                    <textarea name="obs" rows="10" cols="30" maxlength="250" placeholder="Información adicional, relevante para la respuesta inmediata de las autoridades. Evite revictimizar. La contextualización detallada de los hechos se llevará a cabo por el Centro de Salud. Max. 250 Caracteres." ></textarea>
                    <!-- Incluir campo para especificar fecha de los presuntos hechos (algunos casos son repetidos luego requieren ser especificados en campo libre de observaciones)-->
                </form>

                <!-- Ingresar información sobre la IE que reporta el caso sería innecesario en consideración de que el tanto el usuario que reporta como el estudiante reportado tiene una IE asignada en la base de datos. Se deja para mostrar para efectos demostrativos.-->

                <p><br><p style="padding-bottom:10px">4) Institución Educativa que reporta el caso:</p>

                <!-- The drop-down list is outside the form element, but should still be a part of the form. -->

                <select name="IE" form="reporte_abuso" id="in_this_id_apply_selectBoxIt" required>
                <option disabled selected value> -- eliga una opción -- </option>
                <?php
                    //header('Content-Type: text/html; charset=ISO-8859-1');
                    // header(...) command to visualize tilde and ñ, not working. Using utf8_encode()...
                    $i = 1;
                    foreach ($_SESSION['iiee_nombre'] as $value) {
                        echo utf8_encode("<option value=$i>$value</option><br>");
                        $i++;
                    }
                    ?>
                </select>
                <p><br></p>
                <input style="padding:5px" type="submit" value="Reportar" form="id_reporte_abuso">
                <p style="font-size:10px"><i><br>Destinatario: Secretaría de Educación de Tuluá-Valle.</i></p>
            </div>
        </ul>
    </div>


<!-- Keep order of script file calls (before </body>) -->

<script type="text/javascript" src="./scripts/MyScripts.js"></script>

<!--*****************************************************-->
<!--** To handle long strings in select option **-->
<!--*****************************************************-->
<!-- http://gregfranko.com/jquery.selectBoxIt.js -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="http://gregfranko.com/jquery.selectBoxIt.js/js/jquery.selectBoxIt.min.js"></script>

<!-- Script call: http://jsfiddle.net/ZTs42/2/-->
<script>
    $(function(){ // "select" or more specific target "#in_this_id_apply_selectBoxIt"     
        $("select").selectBoxIt({
                                          /* other themes: http://gregfranko.com/jquery.selectBoxIt.js/#DefaultTheme */
                                          theme: "default",
                                          autoWidth: false
                                          });   
    });
</script>
    <!--*****************************************************-->
    <!--*****************************************************-->
</body>
</html>
