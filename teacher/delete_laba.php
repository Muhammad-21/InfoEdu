<?php
    $linkEl=filter_var(trim($_GET['link']),FILTER_SANITIZE_STRING);
    $link = substr($linkEl,20);
    $l=iconv("utf-8", "cp1251", $link);
    $path="../laba/".$l;
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $result=$mysql->query("SELECT * 
    FROM material 
    WHERE material.link='$link'");
    $materials= $result -> fetch_assoc();
    $id = $materials['id_work'];
    $mysql->query("DELETE FROM `work` WHERE `id_work`='$id'");
    unlink($path);
    $mysql->close();
    header('Location: laba.php');
?>