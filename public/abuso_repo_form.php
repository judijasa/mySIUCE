<?php session_start();?>
<!doctype html>
<html>
    <head>

        <title>Formulario: Abuso sexual</title>

        <!-- https://codepen.io/fainder/pen/AydHJ-->

        <meta charset="ISO-8859-1">  <!-- charset="utf-8" -->
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" type="text/css" href="./main.css">
        <!-- 
        <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1"> (not working. Using utf8_encode()...)
        -->

        <!--*****************************************************-->
        <!--*** CSS Bootstrap for mobile styling of input form **-->
        <!--*****************************************************-->
        <!-- Optional link: 
        https://getbootstrap.com/docs/5.0/forms/form-control/ 
        https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_form_basic&stacked=h 
        -->
        <!-- The links and scripts below improve user experience while filling forms in mobile devices. 
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
    <?php
        $current_page = 'abuso_repo_form.php';
    ?>

    <!--***************************************-->
    <!--******* FETCH ALL STUDENTS NUIP *******-->
    <!--***************************************-->
    <?php
    /*
        // mySQL Connect
        require '../config/config.php'; // values of $servername, $dbname, $dbuser, $dbpass
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // SQL Query
            $stmt = $conn->prepare('SELECT nuip FROM estudiantes');
            $stmt->execute();
            // to fetch all rows, use fetchall() instead of fetch(), and arg FETCH_COLUMN
            //https://www.php.net/manual/en/pdostatement.fetchall.php
            $result = $stmt->fetchall(PDO::FETCH_COLUMN); 
            //print_r($result);
        }  catch(PDOException $e) {
        echo "Error: " . "<br>" . $e->getMessage();
        }
        $conn = null;
        */
    ?>
    <!--***************************************-->
    <!--***************************************-->

    <!-- Simulate a smartphone / tablet -->
    <div class="mobile-container">
    
        <ul id="accordion" class="accordion">

            <!-- Top Navigation -->
            <div class="topnav">
                <p class="active">
                <a href="./sub_index_abuso.php" id="previous" style="text-align:left;">&#8249;</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Abuso sexual
                </p>
                <?php  // keep this statment here otherwise problems arise
                    require './includes/topnav.php';
                ?>
            </div>
    
            <!-- Texto -->
            <div class="body_text">
                <p> Para reportar, favor responda a las siguientes preguntas:</p><br>
                <form name="form_name_reporte_abuso" action="./abuso_repo_confirm.php" method="POST" class="formulario" id="id_reporte_abuso" accept-charset="UTF-8" onsubmit="return ValidateForm()">
                    <!-- form="reporte_abuso" -->
                    <fieldset>
                    <legend>Presunta víctima:</legend>
                    <p>Tipo de identificación:</p>  <!-- Para campo requerido poner <sup>*</sup> -->
                    <select name="doc_type" required>
                    <option disabled selected value> -- eliga una opci&oacute;n -- </option>
                    <!-- <option value="CM">Código de matrícula</option> -->
                    <!-- El código de matrícula se descarta. Solo para procesos internos de la IE.
                    Estudiantes de diferentes IE pueden compartir un mismo código de matrícula, lo cual obliga
                    a especificar el IE. -->
                    <!-- <option value="NUIP">Número Único de Identificación Personal</option> -->
                    <!-- En nuestra base de datos, los estudiantes poseen NUIP, en lugar de CC o TI,
                    sin embargo se deja así como demostrativo. -->
                    <option value="NUIP">Tarjeta de identidad</option>
                    <option value="NUIP">Cédula de ciudadanía</option>
                    </select>
                    <br><br><p>Nr. de identificaci&oacute;n:</p>
                    <input pattern="[0-9]{10}" name="doc_num" maxlength="10" value="" placeholder="10 dígitos" class="my-form-control" required><br>
                    <!--
                    <p>Primer nombre:</p>
                    <input type="text" name="1er_nombre" value="" class="my-form-control"><br><br>
                    <p>Segundo nombre:</p>
                    <input type="text" name="2do_nombre" value="" class="my-form-control"><br><br>
                    <p>Primer apellido:</p>
                    <input type="text" name="1er_apellido" value="" class="my-form-control"><br><br>
                    <p>Segundo apellido:</p>
                    <input type="text" name="2do_apellido" value="" class="my-form-control"><br><br>
                    -->
                    </fieldset>
                    <p><br><br></p>
                    <!-- Suffix [] indicates that values will be handled as an array -->
                    <label for="temporalidad"> 1) ¿Ocurri&oacute; en las &uacute;ltimas 72 horas?</label><br><br>
                    <input type="radio" name="temporalidad" value="72+" required>
                    Sí<br><br>
                    <input type="radio" name="temporalidad" value="72-" required>
                    No<br><br>
                    <input type="radio" name="temporalidad" value="INCIERTO" required>
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
                    <textarea name="obs" rows="10" cols="30" maxlength="250" placeholder="Información adicional, relevante para la respuesta inmediata de las autoridades. Evite revictimizar. La contextualización detallada de los hechos se llevará a cabo por el Centro de Salud. Max. 250 Caracteres."></textarea>
                <!-- Incluir campo para especificar fecha de los presuntos hechos (algunos casos son repetidos luego requieren ser especificados en campo libre de observaciones)-->

                <!-- Ingresar información sobre la IE que reporta el caso sería innecesario en consideración de que el tanto el usuario que reporta como el estudiante reportado tiene una IE asignada en la base de datos. Se deja para mostrar para efectos demostrativos.-->
                <!-- The form attribute within form tags: https://www.w3schools.com/tags/att_form.asp -->

                <!-- Question below is removed. Instead we take the user's ie, found in $_SESSION -->
                <!--
                <p><br><p style="padding-bottom:10px">4) Institución Educativa que reporta el caso:</p>
                <select name="IE" form="id_reporte_abuso" required id="in_this_id_apply_selectBoxIt">
                <option disabled selected value> -- eliga una opción -- </option>
                <?php
                    //header('Content-Type: text/html; charset=ISO-8859-1'); 
                    // header(...) command to visualize tilde and ñ, not working. Using utf8_encode().
                    $i = 1;
                    foreach ($_SESSION['iiee_nombre'] as $value) {
                        echo utf8_encode("<option value=$i>$value</option><br>");
                        $i++;
                    }
                ?>
                </select>
                -->
                <!-- To validate student Identif Nr I could use hidden input and a validation like protocol:
                https://www.w3schools.com/js/tryit.asp?filename=tryjs_validation_js 
                But currently using the AJAX method. -->
                <input type="hidden" name="json_nuips" value=<?php include 'get_students_nuip.php'?> form="id_reporte_abuso">
                <br>
                <p style="font-size:12px; display:block"><i>Destinatario: Secretar&iacute;a de Educaci&oacute;n de Tulu&aacute;-Valle.</i></p>
                <br>
                <!-- Tips from
                https://ux.stackexchange.com/questions/1072/ok-cancel-on-left-right
                "Name button to explain what it does rather than a generic label suc as OK.
                 Let the most commonly selected button the default and highlight it (except if dangerous) -->
                <!-- The value attribute within the input tag of submit type is displayed as button's label  -->
                <div class="okcancel">
                <input type="submit" class="form_submit_button" value="Reportar" form="id_reporte_abuso">
                <input type="reset" class="form_reset_button" onclick="window.location='index.php';" value="Cancelar">
                </div>            
                </form>
            </div>
        </ul>
    </div>

    <!-- Keep order of script file calls (before </body>) -->
    <script type="text/javascript" src="./scripts/MyScripts.js"></script>

    <!--*****************************************************-->
    <!--** To handle looong strings in select option **-->
    <!--*****************************************************-->
    <!-- http://gregfranko.com/jquery.selectBoxIt.js -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="http://gregfranko.com/jquery.selectBoxIt.js/js/jquery.selectBoxIt.min.js"></script>

    <!-- Script calls: http://jsfiddle.net/ZTs42/2/ -->
    <script>
        $(function(){ // "select" or for a more specific target: "#in_this_id_apply_selectBoxIt"     
            $("select").selectBoxIt({
                /* other themes: http://gregfranko.com/jquery.selectBoxIt.js/#DefaultTheme */
                theme: "default",
                autoWidth: false
            });   
        });
    </script>
    <!--*****************************************************-->
    <!--*****************************************************-->
    <script>
        // validation: https://www.w3schools.com/js/tryit.asp?filename=tryjs_validation_js
        function ValidateForm() {
            // https://stackoverflow.com/questions/23740548/how-do-i-pass-variables-and-data-from-php-to-javascript

            x = document.forms["form_name_reporte_abuso"]["doc_num"].value; // string because from input type "text"
            nuips = document.forms["form_name_reporte_abuso"]["json_nuips"].value; // array of strings
            // includes(): https://kodlogs.com/45189/how-to-javascript-check-if-element-exists-in-array
            if(!nuips.includes(x)) {
                alert("Número de identificación no registrado");
                return false;
            }
        }
    </script>
<!-- DISABLED because unable to conditioned ValidateForm return value from reqListener.  The latter, being asynchronous
     makes it virtually impossible to force its execution strictly before the return line in ValidateForm.  
    <script>
        function ValidateForm () {
            //var output = true;
            // validation: https://www.w3schools.com/js/tryit.asp?filename=tryjs_validation_js
            let x = document.forms["form_name_reporte_abuso"]["doc_num"].value;

            // We implement the AJAX method to import variables (in this case all students NUIP) from php to javascript:
            // https://stackoverflow.com/questions/23740548/how-do-i-pass-variables-and-data-from-php-to-javascript
            // Beware the latter link defines a reqListener function which is never used in their code. 
            // Though it becomes useful when oReq.onload is replaced by oReq.addEventListener().
            // The AJAX method is based on XMLHttpRequest():
            // https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest

            var oReq = new XMLHttpRequest(); // New request object
            // The onload below is equivalent to addEventListener('load',...)
            // But I want 'load' to be replaced by the 'submit' event.
    
            //oReq.onload = function() {
            function reqListener() {
                // This is where you handle what to do with the response.
                // The actual data is found on this.responseText
                if (!this.responseText.includes(x)) {
                    alert("Número de identificación no registrado");
                    return false;
                }
            }

            /* addEventListener 'submit':
            https://stackoverflow.com/questions/37847745/using-addeventlistener-onsubmit-form
            https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest */
            //document.getElementById("id_reporte_abuso").addEventListener('submit', reqListener);
            //document.forms["form_name_reporte_abuso"].addEventListener("submit", reqListener);

            // https://stackoverflow.com/questions/57360336/return-value-of-event-triggered-function
            // QUESTION: "Return value of event triggered function" 
            // ANSWER: "addEventListener does not return the callback result, returns undefined by design"
            // The same answer redirects to
            // https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener
            // where you should read the section "Usage Notes: The event listener callback"
            
            //oReq.addEventListener('load', reqListener);

            oReq.open("get", "get_students_nuip.php", true);
    //                               ^ Don't block the rest of the execution.
    //                                 Don't wait until the request finishes to
    //                                 continue.
            oReq.send();
            return reqListener();
        }
</script>
-->
</body>
</html>
