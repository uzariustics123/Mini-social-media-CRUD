<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('../config/db.php');

$postid = isset($_POST['postid']) ? $_POST['postid'] : endProcessWithMessage('No provided postid');

$query = $db->prepare("DELETE FROM post WHERE post_id = ?");
        $query->bind_param('i', $postid);
        $query->execute();
    if ($db->affected_rows > 0) {
        $result = array('status' => 'success', 'message' => "Post successfully deleted!");
        echo json_encode($result);
    }else{
        endProcessWithMessage($db->error);
    }

// $checkResult = $query->get_result();

// if ($checkResult->num_rows > 0) {
//     endProcessWithMessage('Email already taken');
// }else{
    
    
// }
