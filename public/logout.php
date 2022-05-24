<?php
session_start();
session_destroy();
    //  Next is the question, to which page to redirect?  Ideally, if in a non session exclusive page, then redirect to the same
    // page as logged out.  And if in a session exclusive page (e.g. report form), then redirect to last non session exclusive
    // page as logged out. This solution requires more coding than necessary for this test app.  Instead we redirect always to index.php 
    //https://stackoverflow.com/questions/5285031/back-to-previous-page-with-header-location-in-php
    // To store previous url in a session variable take into account the user might right click on multiple pages and then come back. 
    
    //header("location://javascript:history.go(-1)");
    //header('location: ' . $_SERVER['HTTP_REFERER']);
    /* ALT:
     if (! empty($_GET['last_page']))
     {
     header('location:' . $_GET['last_page']);
     }
     else
     {
     header('location: ./index.php');
     } */
     header('location: ./index.php');
    ?>
