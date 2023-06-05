<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require 'database.php';
require 'validation.php';
require 'common.php';
require 'dao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') :
    http_response_code(405);
    echo json_encode([
        'Invalid Request Method. HTTP method should be POST',
    ]);
    exit;
endif;

$conn = dbConnection();

// echo file_get_contents('php://input');
$data = json_decode(file_get_contents('php://input'));
// echo "12345654654312";

validate_input($data);

echo insert($data);
?>
