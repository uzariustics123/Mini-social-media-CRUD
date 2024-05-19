<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('../config/db.php');

$postid = isset($_POST['postid']) ? $_POST['postid'] : endProcessWithMessage('No provided postid');
$title = isset($_POST['title']) ? $_POST['title'] : endProcessWithMessage('Please provide your title');
$content = isset($_POST['content']) ? $_POST['content'] : endProcessWithMessage("Please provide your content");

$query = $db->prepare("UPDATE post
        SET
            title = ?,
            content = ? WHERE post_id = ?");
        $query->bind_param('ssi', $title, $content, $postid);
        $query->execute();
    if ($db->affected_rows > 0) {
        $result = array('status' => 'success', 'message' => "Post successfully updated!");
        echo json_encode($result);
    }else{
        endProcessWithMessage($db->error);
    }

// $checkResult = $query->get_result();

// if ($checkResult->num_rows > 0) {
//     endProcessWithMessage('Email already taken');
// }else{
    
    
// }
