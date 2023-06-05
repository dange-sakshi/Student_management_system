
<?php
function insert($data)
{
    $response = null;
        $conn = dbConnection();

        $query = "INSERT INTO `marks`(name, rollNo, std, hindi, marathi, math, sci, history, cs )
        VALUES(:name,:rollNo,:std,:hindi,:marathi,:math,:sci,:history,:cs)";

        $stmt = $conn->prepare($query);

        bind_students($stmt, $data);


        if ($stmt->execute()) {
           $response = readOne(trim($data->rollNo));
        }

       return $response ;
   
}
//update
function update($data)
{

    try {

        $conn = dbConnection();

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
}
//delete
function delete($data)
{
    try {
        $conn = dbConnection();
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
}
//read
function read()
{
    $response = null;

    try {
        $conn = dbConnection();
        $rollNo = null;

        $sql = "SELECT * FROM `marks`";
        //is_numeric($rollNo) ? "SELECT * FROM `marks` WHERE rollNo='$rollNo'" : "SELECT * FROM `marks`";


        $stmt = $conn->prepare($sql);

        $stmt->execute();

        if ($stmt->rowCount() > 0) :
            if (is_numeric($rollNo)) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

            $response = json_encode($data);
        else :
            $response = json_encode([
                'No Result Found!',
            ]);
        endif;
    } catch (PDOException $e) {
        $response = json_encode([
            $e->getMessage()
        ]);
    }
    return $response;
}


// //readOne
function readOne($rollNo)
{
    $response = null;
    $conn = dbConnection();
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

        $response = json_encode([
            $data,
        ]);

    else :
        throw new Exception("No data found for rollNo:$rollNo");
    endif;
    return $response;
}
?>