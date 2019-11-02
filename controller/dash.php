<?php
session_start();
header('Content-Type: application/json');
if(isset($_COOKIE)){
    $id = $_COOKIE['SESSION_ID'];
    $email= $_SESSION[$id];
    $data = file_get_contents("../user.json");
    $json = json_decode($data,true);
    $user = $json[$email];
    $return = array("status" => '1');
    $return['user'] = $user;
    echo json_encode($return);
} else{
    $result = array("status" => "0");
    echo json_encode($result);
}
?>