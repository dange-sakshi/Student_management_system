<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
// header("Access-Control-Allow-Methods: DELETE");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') :
    http_response_code(405);
    echo json_encode([

        'Invalid Request Method. HTTP method should be DELETE',
    ]);
    exit;
endif;

require 'database.php';
// $database = new Database();
$conn = dbConnection();

$data = json_decode(file_get_contents("php://input"));




if (!isset($data)) {
    echo json_encode(['Please provide the roll No.']);
    exit;
}

try {
    $fetch_post = "SELECT * FROM `marks` WHERE rollNo=$data";


    $fetch_stmt = $conn->prepare($fetch_post);
    $fetch_stmt->execute();

    if ($fetch_stmt->rowCount() > 0) :
        echo '#############################';

        $delete_post = "DELETE FROM `marks` WHERE rollNo=$data";
        $delete_post_stmt = $conn->prepare($delete_post);

        if ($delete_post_stmt->execute()) {

            echo json_encode([

                'Post Deleted successfully'
            ]);
            exit;
        }

        echo json_encode([

            'Post Not Deleted. Something is going wrong.'
        ]);
        exit;

    else :
        echo json_encode(['Invalid ID. No posts found by the ID.']);
        exit;
    endif;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([

        $e->getMessage()
    ]);
    exit;
}
