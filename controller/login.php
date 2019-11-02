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

    $query = 'SELECT UUID()';
    $uuid = $conn->query($query)->fetch_row()[0];


    $stmt = $conn->prepare("select * from user where email= ? and password= ? limit 1");
    $stmt->bind_param("ss", $email, $password);

    $email = $_POST["email"];
    $password = $_POST["password"];
    $return = array("status" => "0");
    
    if($stmt->execute()){
        $result = $stmt->get_result();
        try{
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            $return["status"] = "1";
            setcookie("SESSION_ID",$uuid,time()+86400,"/");
            $_SESSION[$uuid] = $email;
        }
            echo json_encode($return);
        }
        catch(Exception $e){
            echo json_encode($return);
        }
        
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