<!--
https://stackoverflow.com/questions/9001702/php-session-destroy-on-log-out-button
https://www.w3schools.com/php/php_form_validation.asp
-->

<!doctype html>
<html>
  <head>

    <title>Login</title>

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
    
      <ul id="accordion" class="accordion">
      
            <!-- Top Navigation -->

            <div class="topnav">
                <p class="active">
                <a href="<?php echo $_GET[last_page]?>" id="previous" style="text-align:left;">&#8249;
                </a>
                </p>

                <div id="myLinks">
                    <a href="#news">Noticias</a>
                    <a href="#contact">Contacto</a>
                    <a href="#about">Acerca de</a>
                </div>
                    <a href="javascript:void(0);" class="icon" onclick="open_top_icon()">
                    <i class="fa fa-bars"></i>
                    </a>
            </div>
    
            <!-- CUERPO -->

                <div class="login">

                <form action="./check.php" method="POST">
                <!--Usuario:-->
                <label for="user_name"><b>Usuario:</b></label>
                <input name="user_name" type="text" class="my-form-control" required>
                <p style="padding-bottom:10px;"></p>

                <!-- Contraseña: -->
                <label for="pass_word"><b>Contraseña:</b></label>
                <input name="pass_word" type="password" class="my-form-control" required><br><br>
                <input type="hidden" name="last_page" value="<?php echo $_GET['last_page'] ?>">
                <input style="padding:5px;" type="submit" value="Enviar">
                </form>

                <?php
                    if ($_GET['verif_stat'] === invalid)
                    {
                ?>
                        <p style="padding-top:10px;">Usuario o contraseña inválida.</p>
                <?php
                    }
                    else
                    {
                ?>
                         <p style="color:transparent">Usuario o contraseña inválida.</p>
                <?php
                    }
                ?>
            </div>
      </ul>
</div>

<!-- Keep order of script calls -->

<!--
online: "http://code.jquery.com/jquery-1.11.1.min.js"

jquery-1.11.1.min.js: only for accordion effect.
-->

<script src="./scripts/jquery-1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="./scripts/MyScripts.js"></script>

</body>
</html>
