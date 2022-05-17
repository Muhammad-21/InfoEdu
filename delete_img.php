<?php
    session_start();
    $l=filter_var(trim($_GET['link']),FILTER_SANITIZE_STRING);
    $path="./img/users/".$l;
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $user_id=$_SESSION["id_user"];
    if($_SESSION['user_sex']==1){
        $link="person.jpg";
    }else{
        $link="personw.jpg";
    }
    $mysql->query("UPDATE `user` SET `photo_link`='$link' WHERE `id_user`='$user_id'");
    $mysql->close();
    unlink($path);
    if($_SESSION['id_student']){
        header('Location: ../student.php');
    }else{
        header('Location: ../teacher/teacher.php');
    }
?>