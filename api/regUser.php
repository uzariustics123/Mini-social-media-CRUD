<?php
// header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json');
include_once('../config/db.php');

$email = isset($_POST['email']) ? $_POST['email'] : endProcessWithMessage('No provided email');
$password = isset($_POST['password']) ? $_POST['password'] : endProcessWithMessage('Please provide your password');
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : endProcessWithMessage("Please provide your first name");
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : endProcessWithMessage("Please provide your last name");

$query = $db->prepare("SELECT userid FROM users WHERE email = ?");
$query->bind_param('s', $email);//binding variable and avoid sql injection
$query->execute();
//execute the query
// $user = $db->query($query);

//check results

$checkResult = $query->get_result();

if ($checkResult->num_rows > 0) {
    endProcessWithMessage('Email already taken');
}else{
    $query = $db->prepare("INSERT INTO users
        SET
            firstname = ?,
            lastname = ?,
            email = ?,
            password = ?");
        $query->bind_param('ssss', $firstname, $lastname, $email, $password);
        $query->execute();
    if ($db->affected_rows > 0) {
        $result = array('status' => 'success', 'message' => "Successfully registered, You can now Log in with your account");
        echo json_encode($result);
    }
    
}
