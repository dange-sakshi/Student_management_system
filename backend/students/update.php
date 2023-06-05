<?php
//update
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require 'database.php';
require 'validation.php';
require 'common.php';
require 'dao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'PUT') :
http_response_code(405);
echo json_encode([
'Invalid Request Method. HTTP method should be PUT',
]);
exit;
endif;
$conn = dbConnection();
$data = json_decode(file_get_contents("php://input"));
if (!isset($data->rollNo)) {
echo json_encode(['Please provide the post ID.']);
exit;
}
update($data);
?>