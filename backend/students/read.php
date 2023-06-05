<?php

require 'dao.php';
if ($_SERVER['REQUEST_METHOD'] !== 'GET') :
    http_response_code(405);
    echo json_encode([
        'Invalid Request Method. HTTP method should be GET',
    ]);
    exit;
endif;

require 'database.php';

$response = read();

echo $response;
exit;
