<?php 
    header('Content-Type: text/html; charset= utf-8');
    $courseName=filter_var(trim($_POST['courseName']),FILTER_SANITIZE_STRING);
    $groupNumber=filter_var(trim($_POST['groupNumber']),FILTER_SANITIZE_STRING);
    $description=filter_var(trim($_POST['description']),FILTER_SANITIZE_STRING);

    $mysql=new mysqli('localhost','root','','InfoEdu');
    $results=$mysql->query("SELECT `id_group` From `group` WHERE `group_number`='$groupNumber'");
    $id=$results->fetch_assoc();
    $id_group = $id["id_group"];
    $mysql->query("INSERT INTO `course` (`course_name`,`description`,`id_group`) VALUES('$courseName','$description','$id_group')");
    $mysql->close();
    header('Location: ../addCourses.php');
?>