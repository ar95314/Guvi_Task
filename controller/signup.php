<?php 
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
    $stmt = $conn->prepare("insert into user (email,password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $password);

    $email = $_POST["email"];
    $password = $_POST["password"];
    if($stmt->execute()){
        $return = array("status" => "1");
        echo json_encode($return);
        $data = file_get_contents("../user.json");
        $json = json_decode($data,true);
        $user = array("email" => $email);
        $json[$email] = $user;

        $fp = fopen('../user.json', 'w');
        fwrite($fp, json_encode($json));
        fclose($fp);
        
    }else{
        $return = array("status" => '0');
        echo json_encode($return);
    }

    $stmt->close();
    $conn->close();
} else{
    $return = array("status" => '0');
    echo json_encode($return);
}

?>