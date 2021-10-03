<?php

$Name = $_POST["Name"];
$USN = $_POST['USN'];
$Collegename = $_POST['Collegename'];
$Semester = $_POST['Semester'];
$Subject = $_POST['Subject'];
$marks = $_POST['marks'];

if(!empty($Name) || !empty($USN) || !empty($Collegename) || !empty($Semester) || !empty($Subject) || !empty($marks))
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
        $SELECT = "SELECT USN From form_db Where USN = ? Limit 1";
        $INSERT = "INSERT Into form_db (Name, USN, Collegename, Semester, Subject, marks) values(?,?,?,?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s", $USN);
        $stmt->execute();
        $stmt->bind_result($USN);
        $stmt->store_result();
        $runm = $stmt->num_rows;

        if($runm==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssss", $Name, $USN, $Collegename, $Semester, $Subject, $marks);
            $stmt->execute();
            echo "Added sucessfully";
        }
        else{
            echo "Addition Unsucessfull";
        }
        $stmt->close();
        $conn->close();
    }
} else{
    echo"All fields are required";
    die();
}
?>