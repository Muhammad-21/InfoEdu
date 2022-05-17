<?php 
    header('Content-Type: text/html; charset= utf-8');
    $status=filter_var(trim($_GET['status']),FILTER_SANITIZE_STRING);
    $id=filter_var(trim($_GET['id']),FILTER_SANITIZE_STRING);
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    if($status == 'add'){
        $mysql->query("UPDATE `user` SET `status`=1 WHERE `id_user`='$id'");
    }elseif($status == 'reject'){
        $mysql->query("DELETE FROM `teacher` WHERE `id_user`='$id'");
        $mysql->query("DELETE FROM `student` WHERE `id_user`='$id'");
        $mysql->query("DELETE FROM `user` WHERE `id_user`='$id'");
    }   
    $mysql->close();
    header('Location: ../addUsers.php');
?>
