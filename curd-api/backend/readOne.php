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

try {
    $fetch_post = "SELECT * FROM `marks` WHERE rollNo=$rollNo";


    $fetch_stmt = $conn->prepare($fetch_post);
    $fetch_stmt->execute();

    if ($fetch_stmt->rowCount() > 0) :

        $data = null;
        if (is_numeric($rollNo)) {
            $data = $fetch_stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $data = $fetch_stmt->fetchAll(PDO::FETCH_ASSOC);
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
