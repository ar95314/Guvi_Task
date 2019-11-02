<?php 
session_start();
header('Content-Type: application/json');
if(isset($_POST)){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "guvi";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("update user set name=?, address=?,country=?,state=?,city=?,phone=?,age=? where email=?");
    $stmt->bind_param("ssssssss", $name,$address,$country,$state,$city,$phone,$age);
    $name = $_POST["name"];
    $address = $_POST["address"];
    $country = $_POST["country"];
    $state = $_POST["state"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $email = $_SESSION[$_COOKIE['SESSION_ID']];
    $stmt->execute();
    
        $return = array("status" => "1");
        echo json_encode($return);

        $data = file_get_contents("../user.json");
        $json = json_decode($data,true);
        $user = $json[$email];
        $user['name'] = $name;
        $user['city'] = $city;
        $user['address'] = $address;
        $user['age'] = $age;
        $user['country'] = $country;
        $user['state'] = $state;
        $user['phone'] = $phone;
        $json[$email] = $user;
        

        $fp = fopen('../user.json', 'w');
        fwrite($fp, json_encode($json));
        fclose($fp);

    $stmt->close();
    $conn->close();
} else{
    $return = array("status" => '0');
    echo json_encode($return);
}

?>