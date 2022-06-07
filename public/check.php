<?php session_start();
         require '../config/config.php'; // values of $servername, $dbname, $dbuser, $dbpass
         header('Content-Type: text/html; charset=ISO-8859-1'); // visualiza tilde y ñ
    
     /*
    
     Authenticating user login with PHP from
     SQL database...
     
     Template code (without SQL)
     Source:
     https://stackoverflow.com/questions/9001702/php-session-destroy-on-log-out-button
     https://www.tutorialspoint.com/php/php_login_example.htm
     
     OTHER ISSUES
     https://stackoverflow.com/questions/4700623/pdos-query-vs-execute
     "For table creation, using QUERY is fine, but to insert, update or select data it is better to use a STATEMENT (i.e. execute)..."
     https://stackoverflow.com/questions/34132261/authenticating-user-login-with-php-from-sqlite-database
     https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
     Many ways to write within prepare()
     https://www.php.net/manual/en/pdostatement.execute.php
     List:
     - Bound values (direct)
     - Named parameters, later using bindValue(...)
     - Placeholders (interrogation marks), later using field evaluated execution: exec(array(val_1,val_2,...))
     One can also skip prepare and insert the string
     command in the execution command field e.g.
     https://www.if-not-true-then-false.com/2012/php-pdo-sqlite3-example/
     
     When connecting to a mysql database from a php
     you need a username and password.  Anyone with
    access to the php will be able to see them.
     How to prevent this?
     
     https://stackoverflow.com/questions/23454719/connect-to-mysql-database-without-showing-password/23454824
     
     redirects to
     
     https://stackoverflow.com/questions/97984/how-to-secure-database-passwords-in-php
     */
    
     // Define Functions...
    
     function get_profile_basic($var_user,$var_password)
     {
         if($var_user === 'valid_username' && $var_password === 'valid_password')
         {
             return 'true';
         }
         else
         {
             return 'false';
         }
     }
    
     function get_profile($var_user,$var_password,$var_servername,$var_dbname,$var_dbuser,$var_dbpass)
     {
        // https://www.w3schools.com/php/php_mysql_select.asp
        
        // The variables $servername, $username, $password, $dbname
        // are defined securely in config.php protected file
        // https://stackoverflow.com/questions/97984/how-to-secure-database-passwords-in-php
        
         try {
             // Database Connection
             $conn = new PDO("mysql:host=$var_servername;dbname=$var_dbname", $var_dbuser, $var_dbpass);
             // set the PDO error mode to exception
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
             // mySQL Query
             $stmt = $conn->prepare('SELECT id, primer_nombre, ie, password FROM usuarios WHERE username = :usr');
             $stmt->bindValue(':usr', $var_user);
             $stmt->execute();
        
             // Associative array refers to an array with strings as an index.
             // Set the resulting array to associative:
             // using fetch() vs setFetchMode()...
             // https://itqna.net/questions/11997/difference-between-fetch-and-setfetchmode-methods-pdo
             //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); // This method is not working. I don't know why.
             $result = $stmt->fetch(PDO::FETCH_ASSOC); // This method is working.
             $verif = password_verify($var_password, $result['password']);
             if ($verif){
                 $_SESSION['logged_in'] = true;
                 $_SESSION['user_name'] = $var_user;
                 $_SESSION['user_id'] = $result['id'];
                 $_SESSION['primer_nombre'] = $result['primer_nombre'];
                 $_SESSION['ie_id'] = $result['ie']; // user's ie id
             }
         }  catch(PDOException $e) {
            echo "Error: " . "<br>" . $e->getMessage();
         }
         $conn = null;

         // https://www.phptutorial.info/?password-verify
         // Verifies that the given hash matches the given password.
         return $verif;
     }

     function go_back($var)
     {
         if (! empty($_POST['last_page']))
         {
            header('location:' . $var . $_POST['last_page']);
         }
         else
         {
            header('location:./index.php');
         }
     }  // end of function definition
     
     // Code sequence...
     //get_profile($_POST['user_name'],$_POST['pass_word'],$servername,$dbname,$dbuser,$dbpass);
     
     if (! empty($_POST) && ! empty($_POST['user_name']) && ! empty($_POST['pass_word']) )
     {
         if(get_profile($_POST['user_name'],$_POST['pass_word'],$servername,$dbname,$dbuser,$dbpass))
         {
             // mySQL Connect
             try {
                 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
                 // set the PDO error mode to exception
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
                 // mySQL Query
                 $stmt = $conn->prepare('SELECT nombre FROM iiee');
                 $stmt->execute();
                 
                 $_SESSION['iiee_nombre'] = array();
                 $i = 0;
                 while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ //setFetchMode() not working
                 if(!isset($result['nombre'])) continue;
                 $_SESSION['iiee_nombre'][$i] = $result['nombre'];
                 $i++;
                 }
                 // ie in user table is a number.  Here it is translated into a name...
                 $_SESSION['ie']=$_SESSION['iiee_nombre'][$_SESSION['ie_id']];
             } catch(PDOException $e) {
             echo "Error: " . "<br>" . $e->getMessage();
             }
             go_back('');
             // BEFORE: header('location: ./index.php');
         }
         else
         {
             // resend via GET, $last_page (before login) and $verif_stat
             go_back('./login.php?verif_stat=invalid&last_page=');
             // BEFORE: header('location: ./login.php');
         }
     }
?>

