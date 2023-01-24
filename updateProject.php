<?php

include ('dbContext.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("update students_projects set name= ? , course = ?, fees = ?, status = ? where id = ?");
    $stmt->bind_param("sssss", $name, $course, $fees, $status, $project_id);

    $project_id = $_POST['project_id'];
    $name = $_POST['studentname'];
    $course = $_POST['course'];
    $fees = $_POST['fees'];
    $status = $_POST['status'];

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();
}

