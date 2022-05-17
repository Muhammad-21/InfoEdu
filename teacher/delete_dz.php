<?php
    header('Content-Type: text/html; charset= utf-8');
    $id=filter_var(trim($_GET['id']),FILTER_SANITIZE_STRING);
    $message=filter_var(trim($_GET['message']),FILTER_SANITIZE_STRING);
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $mysql->query("UPDATE `work` SET `assessmeent`='-2',`comment`='$message' WHERE `id_work`=$id");
    $mysql->close();
    if($type==1){
        header('Location: laba_work.php');
    }else{
        header('Location: home_work.php');
    }
?>