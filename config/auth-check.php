<?php

// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('db.php');

$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : gotoLogin();

$query = $db->prepare("SELECT userid FROM users WHERE userid = ?");
$query->bind_param('i', $userid);//binding variable and avoid sql injection
$query->execute();
//execute the query
// $user = $db->query($query);

//check results

$user = $query->get_result();

if ($db->affected_rows > 0) {
} else {

    //  endProcessWithMessage("Unauthorized user " . "$query");
    
}

function gotoLogin()
{
     die();
     header('location: index.php');
}