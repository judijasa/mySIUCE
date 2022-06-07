<?php

     // Create table to visualize data fetch from database
        
     echo "<table style='border: solid 1px black;'>";
     echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";
     
     // A class is a collection of OBJECTS, in this case functions
     class TableRows extends RecursiveIteratorIterator {
         function __construct($it) {
         parent::__construct($it, self::LEAVES_ONLY);
         }

         function current() {
         return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
         }

         function beginChildren() {
         echo "<tr>";
         }

         function endChildren() {
         echo "</tr>" . "\n";
         }
     }

     include 'config/config.php';
        
     header('Content-Type: text/html; charset=ISO-8859-1'); // visualiza tilde y ñ

     // Create connection

     try {
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $stmt = $conn->prepare("SELECT id, primer_nombre, segundo_nombre FROM usuarios");
         $stmt->execute();

         // set the resulting array to associative
         $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
         foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
         echo $v;
         }
     } catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
     }
     $conn = null;
     echo "</table>";
?>
