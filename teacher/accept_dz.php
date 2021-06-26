<?php
    header('Content-Type: text/html; charset= utf-8');
    $id=filter_var(trim($_GET['id']),FILTER_SANITIZE_STRING);
    $mark=filter_var(trim($_GET['mark']),FILTER_SANITIZE_STRING);
    $type=filter_var(trim($_GET['type']),FILTER_SANITIZE_STRING);
    if($mark>100 || $mark==''){
        echo "неверный балл";
        exit();
    }
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $mysql->query("UPDATE `work` SET `assessmeent`='$mark' WHERE `id_work`=$id");
    $mysql->close();
    if($type==1){
        header('Location: laba_work.php');
    }else{
        header('Location: home_work.php');
    }
?>