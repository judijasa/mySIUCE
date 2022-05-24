<html>
    <body>

            <!-- Top Navigation -->

                <div id="myLinks">
                    <?php
                        if (! empty($_SESSION['logged_in']))
                        {
                        ?>
                            <a href="./usuario.php">
                            <i class="fa fa-user"></i>&nbsp;&nbsp;
                            <em><?php echo $_SESSION['user_name'] ?></em></a>
                            <a href="./logout.php">Cerrar sesión</a>
                        <?php
                        }
                        else
                        {
                        ?>

                        <!-- https://stackoverflow.com/questions/871858/php-pass-variable-to-next-page
                        -->

                                <a href="./login.php?last_page=<?php echo $current_page?>">Iniciar sesión</a>

                        <!-- ALTERNATIVE (PASS VAR TO NEXT PAGE):
                            https://stackoverflow.com/questions/7340300/a-tag-as-a-submit-button

                            <form id="myform" action="./login.php" method="GET">
                            <input type="hidden" name="last_page" value="./index.php">
                            <a href="javascript:void(0)" onclick="document.getElementById('myform').submit()">Iniciar sesión</a>
                            </form>
                        -->

                        <?php
                        }
                        ?>
                        <a href="#news">Noticias</a>
                        <a href="#contact">Contacto</a>
                        <a href="#about">Acerca de</a>
                    </div>
                    <a href="javascript:void(0);" class="icon" onclick="open_top_icon()">
                    <i class="fa fa-bars"></i>
                    </a>
    </body>
<html>
