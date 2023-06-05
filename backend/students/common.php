 <?php
function bind_students($stmt, $data){


$stmt->bindValue(':name', htmlspecialchars(trim($data->name)), PDO::PARAM_STR);
$stmt->bindValue(':rollNo', htmlspecialchars(trim($data->rollNo)), PDO::PARAM_STR);
$stmt->bindValue(':std', htmlspecialchars(trim($data->std)), PDO::PARAM_STR);
$stmt->bindValue(':hindi', htmlspecialchars(trim($data->hindi)), PDO::PARAM_STR);
$stmt->bindValue(':marathi', htmlspecialchars(trim($data->marathi)), PDO::PARAM_STR);
$stmt->bindValue(':math', htmlspecialchars(trim($data->math)), PDO::PARAM_STR);
$stmt->bindValue(':sci', htmlspecialchars(trim($data->sci)), PDO::PARAM_STR);
$stmt->bindValue(':history', htmlspecialchars(trim($data->history)), PDO::PARAM_STR);
$stmt->bindValue(':cs', htmlspecialchars(trim($data->cs)), PDO::PARAM_STR);
// $stmt->bindValue(':id', $data->rollNo, PDO::PARAM_INT);

        

}
