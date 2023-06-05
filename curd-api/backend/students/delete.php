<?php
//delete
require 'dao.php';
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
delete($data);

?>