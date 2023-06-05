<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] !== 'GET') :
    http_response_code(405);
    echo json_encode([

        'Invalid Request Method. HTTP method should be GET',
    ]);
    exit;
endif;
require 'database.php';
// $database = new Database();
// $conn = dbConnection();
$conn = dbConnection();
$rollNo = null;

if (isset($_GET['rollNo'])) {
    $rollNo = filter_var($_GET['rollNo'], FILTER_VALIDATE_INT, [
        'options' => [
            'default' => 'all_posts',
            'min_range' => 1
        ]
    ]);
}

try {
    $sql = is_numeric($rollNo) ? "SELECT * FROM `marks` WHERE rollNo='$rollNo'" : "SELECT * FROM `marks`";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    if ($stmt->rowCount() > 0) :

        $data = null;
        if (is_numeric($rollNo)) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        echo json_encode([

            'data' => $data,
        ]);

    else :
        echo json_encode([

            'No Result Found!',
        ]);
    endif;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([

        $e->getMessage()
    ]);
    exit;
}
