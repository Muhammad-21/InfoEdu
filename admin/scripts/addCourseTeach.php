<?php 
    header('Content-Type: text/html; charset= utf-8');
    $teacher=filter_var(trim($_POST['teacher']),FILTER_SANITIZE_STRING);
    $post=filter_var(trim($_POST['type-lesson']),FILTER_SANITIZE_STRING);
    $course=filter_var(trim($_POST['course']),FILTER_SANITIZE_STRING);
    $id_course = explode(' ', $course)[1];
    $id_teacher = explode(' ', $teacher)[1];
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $mysql->query("INSERT INTO `teaches` (`id_teacher`,`id_course`,`post`) VALUES('$id_teacher','$id_course','$post')");
    $mysql->close();
    header('Location: ../addCourseTeach.php');
?>