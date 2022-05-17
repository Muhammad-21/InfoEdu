<?php
    session_start();
    $mail=filter_var(trim($_POST['mail']),FILTER_SANITIZE_STRING);
    $user_id=$_SESSION["id_user"];
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $mysql->query("UPDATE `user` SET `email`='$mail' WHERE `id_user`=$user_id");
    $mysql->close();
    header('Location: ../teacher/teacher.php');
?>