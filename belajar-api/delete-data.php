<?php
include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'DELETE') {
    http_response_code(400);
    echo 'Only DELETE method is allowed.';
    exit();
}

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

$id = $_GET['student_id'];

$sql = mysqli_query($connect, "DELETE FROM students WHERE student_id = $id");
$affectRow = mysqli_affected_rows($connect);

header('Content-Tupe; a[[;ocatomp/json');
echo json_encode(['status' => 'OK', 'msg' => 'Data has been edited succesfully', 'affected_row' => $affectRow]);