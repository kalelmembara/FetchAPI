<?php
include 'connection.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method !== 'PUT') {
    http_response_code(400);
    echo json_encode(['status' => 'ERROR', 'msg' => 'Only PATCH method is allowed.']);
    exit();
}

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

// Validasi data masuk
if (!isset($data['student_id'], $data['student_name'], $data['student_no'], $data['student_class'])) {
    http_response_code(400);
    echo json_encode(['status' => 'ERROR', 'msg' => 'Missing required fields.']);
    exit();
}

$id = mysqli_real_escape_string($connect, $data['student_id']);
$name = mysqli_real_escape_string($connect, $data['student_name']);
$no = mysqli_real_escape_string($connect, $data['student_no']);
$class = mysqli_real_escape_string($connect, $data['student_class']);

$sql = mysqli_query($connect, "UPDATE students SET student_no = '$no', student_name = '$name', student_class = '$class' WHERE student_id = '$id'");

$affectedRow = mysqli_affected_rows($connect);

header('Content-Type: application/json');

if ($sql) {
    echo json_encode([
        'status' => 'OK',
        'msg' => 'Data has been edited successfully.',
        'affected_row' => $affectedRow
    ]);
} else {
    echo json_encode([
        'status' => 'ERROR',
        'msg' => 'Query error: ' . mysqli_error($connect)
    ]);
}
?>
