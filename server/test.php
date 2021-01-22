<?php
$rand = rand(1, 6);
sleep($rand);

header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$result = ['success' => false];
if ($rand % 2 === 0) {
    $result = ['success' => true];
}

echo json_encode($result);
die();