<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('../config/db.php');

$userid = isset($_POST['userid']) ? $_POST['userid'] : endProcessWithMessage('No provided userid');
$title = isset($_POST['title']) ? $_POST['title'] : endProcessWithMessage('Please provide your title');
$content = isset($_POST['content']) ? $_POST['content'] : endProcessWithMessage("Please provide your content");

$query = $db->prepare("INSERT INTO post
        SET
            title = ?,
            content = ?,
            author_id = ?");
        $query->bind_param('ssi', $title, $content, $userid);
        $query->execute();
    if ($db->affected_rows > 0) {
        $result = array('status' => 'success', 'message' => "Post successfully created!");
        echo json_encode($result);
    }else{
        endProcessWithMessage($db->error);
    }

// $checkResult = $query->get_result();

// if ($checkResult->num_rows > 0) {
//     endProcessWithMessage('Email already taken');
// }else{
    
    
// }
