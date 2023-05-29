<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $time = date("Y-m-d h:i:s");
    $result = ['time' => $time];
    echo json_encode($result);
    die;
}