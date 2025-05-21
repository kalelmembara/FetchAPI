<?php
include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'POST') {
    http_response_code(400);
    echo 'Only POST method is allowed.';
    exit();
}

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

//function createUser ($postData)
$name = $data['student_name'];
$no = $data['student_no'];
$class = $data['student_class'];

$sql = mysqli_query($connect, "INSERT INTO students (student_id, student_no, student_name, student_class) VALUES (null,'$no', '$name', '$class')");
$insertedId = mysqli_insert_id($connect);

header('Content_Type: application/json');
echo json_encode([
    'status' => 'OK',
    'msg'    => 'Data has been created succesfully.',
    'inserted-id' => $insertedId
    ]);