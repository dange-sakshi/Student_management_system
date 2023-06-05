   <?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: PUT");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    require 'database.php';
    require 'validation.php';
    require 'common.php';

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
    try {
       


            $update_query = "UPDATE `marks` SET name = :name, rollNo = :rollNo, std = :std, hindi = :hindi,
        marathi = :marathi, math = :math, sci = :sci, history = :history, cs = :cs
        WHERE rollNo = :rollNo";

            $update_stmt = $conn->prepare($update_query);


            bind_students($update_stmt, $data);
         

           



            if ($update_stmt->execute()) {

                echo json_encode([

                    'Post updated successfully'
                ]);
                exit;
            }

            echo json_encode([

                'Post Not updated. Something is going wrong.'
            ]);
            exit;

        // else :
        //     echo json_encode(['success' => 0, 'message' => 'Invalid ID. No posts found by the ID.']);
        //     exit;
        // endif;
        
    } catch (PDOException $e) {

        http_response_code(500);
        echo json_encode([

            $e->getMessage()
        ]);
        exit;
    }

    ?>