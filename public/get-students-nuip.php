<?php
    /***************************************/
    /******* FETCH ALL STUDENTS NUIP *******/
    /* To be used in abuso_repo_form.php
     to call php variables (coming out from
     mySQL connection) within javascript function
     ValidaeForm(), using the AJAX method (see link).
     
     https://stackoverflow.com/questions/23740548/how-do-i-pass-variables-and-data-from-php-to-javascript
                                           */
    /***************************************/
    
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
        echo json_encode($result);
    ?>
