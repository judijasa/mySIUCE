<?php session_start();
    
    /* Template code (without SQL)
    
     REFS:
     https://stackoverflow.com/questions/9001702/php-session-destroy-on-log-out-button
     https://www.tutorialspoint.com/php/php_login_example.htm

    // REFS:
    // http://zetcode.com/php/sqlite3/
    // OTHER ISSUES
    // https://stackoverflow.com/questions/4700623/pdos-query-vs-execute
    // "For a table creation, a QUERY might be fine (and easier) but for an insert, update or select, you should really use a STATEMENT (i.e. execute)..."
    // https://www.php.net/manual/en/sqlite3.query.php
    // https://stackoverflow.com/questions/34132261/authenticating-user-login-with-php-from-sqlite-database
    // https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
    /* Many ways to write within prepare()
     https://www.php.net/manual/en/pdostatement.execute.php
     List:
     - Bound values (direct)
     - Named pameters, later using bindValue(...)
     - Placeholders (interrogation marks), later using field evaluated execution: exec(array(val_1,val_2,...))
     One can also skip prepare and insert the string
     command in the execution command field e.g.
     https://www.if-not-true-then-false.com/2012/php-pdo-sqlite3-example/
     */
    // Currently used code
    
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
    
    function get_profile($var_user,$var_password)
    {
    // Instantiate object:
    $db = new SQLite3('./base_datos.db');
    // ALT: new PDO('sqlite:base_datos.db');
    $statement = $db->prepare('SELECT * FROM usuarios WHERE username = :usr;');
    $statement->bindValue(':usr', $var_user);
    $result = $statement->execute();
    $user_info = $result->fetchArray(SQLITE3_ASSOC);
    $_SESSION['usr_id'] = $user_info['id'];
    
    /*
     $_SESSION['primer_nombre'] = $usr['primer_nombre'];
     $_SESSION['segundo_nombre'] = $usr['segundo_nombre'];
     $_SESSION['primer_apellido'] = $usr['primer_apellido'];
     $_SESSION['segundo_apellido'] = $usr['segundo_apellido'];
     $_SESSION['email'] = $usr['email'];
     $_SESSION['IE'] = $usr['IE'];
     */
    
//    echo $usr['password'];

    // https://www.phptutorial.info/?password-verify
    // password_verify ( string $password , string $hash )
    // Verifies that the given hash matches the given password.
    // echo password_verify( $_POST['pass_word'], $user->password );
    return password_verify( $var_password, $user_info['password'] );
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
}

        // Code sequence...

if (! empty($_POST) && ! empty($_POST['user_name']) && ! empty($_POST['pass_word']) )
{
 if(get_profile($_POST['user_name'],$_POST['pass_word']))
 {
     $_SESSION['logged_in'] = true;
     $_SESSION['user_name'] = $_POST['user_name'];

     /* BEGIN: Donwload IIEE */
     $db = new SQLite3('./base_datos.db');
     $statement = $db->prepare('SELECT nombre FROM IIEE;');
     $result = $statement->execute();
     
     $_SESSION['iiee_nombre'] = array();
     $i = 0;
     
     while($res = $result->fetchArray(SQLITE3_ASSOC)){
         
         if(!isset($res['nombre'])) continue;
         $_SESSION['iiee_nombre'][$i] = $res['nombre'];
         $i++;
         
     }
     /* END: Donwload IIEE */
     
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

