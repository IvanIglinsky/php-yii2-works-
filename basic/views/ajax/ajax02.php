<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $data = file_get_contents('php://input');
    $dataDecoded = json_decode($data, true);
    $dataDecoded['fullName'] = $dataDecoded['firstName'] . " " . $dataDecoded['lastName'];
    $result = ['data' => $dataDecoded];
    echo json_encode($result);
    die;
}