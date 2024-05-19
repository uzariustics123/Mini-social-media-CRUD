<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('../config/db.php');
session_start();
try {
    session_destroy();
    $result = array('status' => 'success', 'message' => "You've been logged out.");
        echo json_encode($result);
} catch (Exception $e) {
    endProcessWithMessage('Something went wrong' . $e);
}
