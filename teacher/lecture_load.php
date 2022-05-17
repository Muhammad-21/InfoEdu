<?php
session_start();
header('Content-Type: text/html; charset= utf-8');
$text=filter_var(trim($_POST['text']),FILTER_SANITIZE_STRING);
$number=filter_var(trim($_POST['number']),FILTER_SANITIZE_STRING);
// echo $_FILES['file']['size'].'<br>';
// echo $_FILES['file']['name'].'<br>';
// echo $_FILES['file']['tmp_name'].'<br>';
$id_teacher=$_SESSION['id_teacher'];
$name1=time().$_FILES['file']['name'];
$name=iconv("utf-8", "cp1251", $name1);
$size=$_FILES['file']['size'];
$lecture="Лекция №".$number;
if(strlen($text)>60){
    $_SESSION['file_status']=-2;
    header('Location: lecture.php');
}elseif($number>15 || $number<1){
    $_SESSION['file_status']=2;
    header('Location: lecture.php');
    exit();
}
if($size>1048576*11){
    $_SESSION['file_status']=-1;
    header('Location: lecture.php');
    exit();
}
if(move_uploaded_file($_FILES['file']['tmp_name'],'../lecture/'.$name)){
    $_SESSION['file_status']=1;
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $mysql->query("INSERT INTO `work`(`work_name`, `work_type`,`assessmeent`,`comment`,`id_student`,`id_teacher`) VALUES('$text', 'лекция', '-5', '-', '84', '$id_teacher')");
    $result=$mysql->query("SELECT * FROM `work` WHERE 1 order by `id_work` desc limit 1");
    $last_id= $result -> fetch_assoc();
    //id работы
    $id_last=$last_id['id_work'];

    $result1=$mysql->query("SELECT * FROM lesson WHERE type_lesson='Лекция' AND name_lesson='$lecture'");
    $lesson_id= $result1 -> fetch_assoc();
    //id занятии
    $id_lesson=$lesson_id['id_lesson'];
    $mysql->query("INSERT INTO `material`(`link`, `id_lesson`,`id_work`) VALUES('$name1','$id_lesson','$id_last')");
    
    $result2=$mysql->query("SELECT * FROM `material` WHERE 1 order by `id_material` desc limit 1");
    $material_id= $result2 -> fetch_assoc();
    //id материала
    $id_material=$material_id['id_material'];
    $mysql->query("INSERT INTO `has`(`id_material`, `id_lesson`) VALUES('$id_material','$id_lesson')");
    $mysql->close();
    header('Location: lecture.php');
}else {
    $_SESSION['file_status']=0;
    header('Location: lecture.php');
}
?>