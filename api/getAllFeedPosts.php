<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('../config/db.php');

// $email = isset($_POST['email']) ? $_POST['email'] : endProcessWithMessage('No provided email');
// $password = isset($_POST['password']) ? $_POST['password'] : endProcessWithMessage('Please provide your password');
// $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : endProcessWithMessage("Please provide your first name");
// $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : endProcessWithMessage("Please provide your last name");

$query = $db->prepare("SELECT * FROM post 
LEFT OUTER JOIN users ON users.userid = post.author_id ORDER BY post_id DESC");
// $query->bind_param('ii', $orgid, $deptid);
$query->execute();
// $user = $db->query($query);

//check results

$checkResult = $query->get_result();

$result = array();

if ($row = $checkResult->num_rows > 0) {
    $rows = array();
    while ($row = $checkResult->fetch_assoc()) {
        $rows[] = $row;
    }
    $result = array('status' => 'success', 'message' => "success getting list of posts", 'data' => $rows);
    echo json_encode($result);
} else {
    endProcessWithMessage("Currently no feeds to show!");
}