<?php 
    header('Content-Type: text/html; charset= utf-8');
    $courseName=filter_var(trim($_POST['courseName']),FILTER_SANITIZE_STRING);
    $groupNumber=filter_var(trim($_POST['groupNumber']),FILTER_SANITIZE_STRING);
    $description=filter_var(trim($_POST['description']),FILTER_SANITIZE_STRING);
    $elective=filter_var(trim($_POST['course-type']),FILTER_SANITIZE_STRING);
    $semester=filter_var(trim($_POST['semester']),FILTER_SANITIZE_STRING);

    if($elective == "да"){
        $status = 1;
    }else{
        $status = 0;
    }
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $results=$mysql->query("SELECT `id_group` From `group` WHERE `group_number`='$groupNumber'");
    $id=$results->fetch_assoc();
    $id_group = $id["id_group"];
    $mysql->query("INSERT INTO `course` (`course_name`,`description`,`elective`,`semester`,`id_group`) VALUES('$courseName','$description','$status','$semester','$id_group')");
    $mysql->close();
    header('Location: ../addCourses.php');
?>