<?php
session_start();
$name1=time().$_FILES['image']['name'];
$name=iconv("utf-8", "cp1251", $name1);
$user_id=$_SESSION["id_user"];
if($_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' && $_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/bmp' && $_FILES['image']['type']!='image/gif'){
    $_SESSION['img_status']=1;
    header('Location: ../teacher/teacher.php');
}else{
    if(move_uploaded_file($_FILES['image']['tmp_name'],'./img/users/'.$name)){
        $mysql=new mysqli('localhost','root','','InfoEdu');
        $mysql->query("UPDATE `user` SET `photo_link`='$name' WHERE `id_user`=$user_id");
        $mysql->close();
        $_SESSION['img_status']='success';
        if($_SESSION['id_student']){
            header('Location: ../student.php');
        }else{
            header('Location: ../teacher/teacher.php');
        }
    }else{
        $_SESSION['img_status']=-1;
        if($_SESSION['id_student']){
            header('Location: ../student.php');
        }else{
            header('Location: ../teacher/teacher.php');
        }
    }
}