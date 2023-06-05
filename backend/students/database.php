<?php




function dbConnection(){

    $db_host = 'localhost';
    $db_name = 'student';
    $db_username = 'root';
    $db_password = 'root123';

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        // $conn = new PDO('mysql:host='. $db_host . ';dbname=' . $db_name, $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection error "  .$e->getMessage();
        exit;
    
     }



}




?>


