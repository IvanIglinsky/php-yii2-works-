<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $studentsJSON = file_get_contents('students.json');
    $students = json_decode($studentsJSON, true);

    $studentJSON = file_get_contents('php://input');
    $student = json_decode($studentJSON, true);

    foreach($students as $studentItem) {
        if ($studentItem['name'] == $student['name']) {
            echo json_encode(['result' => join($studentItem['languages'], ", ")]);
            die;
        }
    }

    echo json_encode(['result' => "Not Found"]);
    die;
}