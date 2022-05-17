<?php
    session_start();
    $user_id=$_SESSION["id_user"];
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $mysql->query("UPDATE `user` SET `email`=NULL WHERE `id_user`=$user_id");
    $mysql->close();
    header('Location: ../teacher/teacher.php');
?>