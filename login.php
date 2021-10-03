<?php


$Email = $_POST['Email'];
$Password = $_POST['Password'];

if(!empty($Email) || !empty($Password))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "s_db";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

        if($runm==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ss", $Email, $Password);
            $stmt->execute();
            header('location: home.html');
        }
        else{
            echo "Someone already registerd useing this email";
        }
        $stmt->close();
        $conn->close();
} else{
    echo"All fields are required";
    die();
}
?>