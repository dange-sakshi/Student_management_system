<?php

//

require 'database.php';
// $database = new Database();
$conn = dbConnection();

// $data = json_decode(file_get_contents("php://input"));

$rollNo = $_GET['rollNumber'];


if (!isset($_GET['rollNumber'])) {
    echo json_encode(['Please provide the roll Nom.']);
    exit;
}
readOne();
?>