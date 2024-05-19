<?php
//host, username, password, db name,
// $db = new mysqli('localhost', 'root', '', 'events_management');
$dbcon = '';
$db = new mysqli('localhost', 'root', '', 'crudbase');
if ($db->connect_error) {
        endProcessWithMessage("Connection failed: " . $conn->connect_error);
} 

function endProcessWithMessage($msg)
{

     $result = array('status' => 'error', 'message' => "$msg");

     echo json_encode($result);

     die();
}