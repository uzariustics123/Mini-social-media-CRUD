<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('../config/db.php');

$email = isset($_POST['email']) ? $_POST['email'] : endProcessWithMessage('No provided email');
$password = isset($_POST['password']) ? $_POST['password'] : endProcessWithMessage('No provided pass');

$query = $db->prepare("SELECT userid FROM users WHERE email = ? AND password = ?");
$query->bind_param('ss', $email, $password);//binding variable and avoid sql injection
$query->execute();
//execute the query
// $user = $db->query($query);

//check results

$user = $query->get_result();

if ($user->num_rows > 0) {
    $row = $user->fetch_assoc();
    $userid = $row['userid'];
    $result = array('status' => 'success', 'message' => "Successfully logged in." . $userid);
    session_start();
    $_SESSION['userid'] = $userid;
    echo json_encode($result);
}else{
    endProcessWithMessage('No user found '.$db->error . $user->num_rows);
}
