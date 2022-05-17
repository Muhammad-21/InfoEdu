<?php
    $linkEl=filter_var(trim($_GET['link']),FILTER_SANITIZE_STRING);
    $link = substr($linkEl,23);
    $l=iconv("utf-8", "cp1251", $link);
    $path="../seminar/".$l;
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $result=$mysql->query("SELECT * 
    FROM material 
    WHERE material.link='$link'");
    $materials= $result -> fetch_assoc();
    $id = $materials['id_work'];
    $mysql->query("DELETE FROM `work` WHERE `id_work`='$id'");
    unlink($path);
    $mysql->close();
    header('Location: seminar.php');
?>