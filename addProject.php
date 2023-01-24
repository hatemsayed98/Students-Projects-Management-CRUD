<?php
include ("dbContext.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $stmt = $conn->prepare("insert into students_projects(name,course,fees,status)values(?,?,?,?)");
    $stmt->bind_param("ssss",$name,$course,$fees,$status);
    
    
    $name = $_POST['studentname'];
    $course = $_POST['course'];
    $fees = $_POST['fees'];
    $status = $_POST['status'];

    if($stmt->execute())
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

    $stmt->close();
}

    

