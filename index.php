<?php

$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Password = $_POST['Password'];
$ConfirmPassword = $_POST['ConfirmPassword'];

if(!empty($Name) || !empty($Email) || !empty($Password) || !empty($ConfirmPassword))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "s_db";

    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}

    else{
        $SELECT = "SELECT Email From details_db Where Email = ? Limit 1";
        $INSERT = "INSERT Into details_db (Name, Email, Password, ConfirmPassword) values(?,?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $runm = $stmt->num_rows;

        if($runm==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssss", $Name, $Email, $Password, $ConfirmPassword);
            $stmt->execute();
            echo "Signup sucessfully";
        }
        else{
            echo "Someone already registerd useing this email";
        }
        $stmt->close();
        $conn->close();
    }
} else{
    echo"All fields are required";
    die();
}
?>