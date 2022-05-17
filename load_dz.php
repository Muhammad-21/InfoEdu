<?php
    session_start();
    header('Content-Type: text/html; charset= utf-8');
    $number_lesson=filter_var(trim($_GET['name_lesson']),FILTER_SANITIZE_STRING);
    $dz_name=filter_var(trim($_GET['work_name']),FILTER_SANITIZE_STRING);
    $linkEl=filter_var(trim($_GET['link']),FILTER_SANITIZE_STRING);
    $laba=filter_var(trim($_GET['laba']),FILTER_SANITIZE_STRING);
    $l=iconv("utf-8", "cp1251", $linkEl);
    if($laba==1){
        $pth="dz_laba/";
        $typel='Лабораторная';
        $lecture="Лабораторная №".$number_lesson;
        $nt=3;
    }else{
        $pth="dz_seminar/";
        $lecture="Семинар №".$number_lesson;
        $typel='Семинар';
        $nt=2;
    }
    if($linkEl) {
        $path=$pth.$l;
        $mysql=new mysqli('localhost','root','','InfoEdu');
        $res=$mysql->query("SELECT * 
        FROM material 
        WHERE material.link='$linkEl'");
        $materials= $res -> fetch_assoc();
        $idd = $materials['id_work'];
        $mysql->query("DELETE FROM `work` WHERE `id_work`='$idd'");
        unlink($path);
        $mysql->close();
    }
    $file=time().$_FILES['file']['name'];
    $file_name=iconv("utf-8", "cp1251", $file);
    $size=$_FILES['file']['size'];

    if($size>1048576*11){
        $_SESSION['file_dz_status']=-1;
        if( $laba==1){
             $laba='';
            header('Location: laba.php');
        }else{
            header('Location: seminar.php');
        }
        exit();
    }
    if(move_uploaded_file($_FILES['file']['tmp_name'],$pth.$file_name)){
        $_SESSION['file_dz_status']=1;
        $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
        $st_id=$_SESSION['id_student'];
        $mysql->query("INSERT INTO `work`(`work_name`, `work_type`,`assessmeent`,`comment`,`id_student`,`id_teacher`) VALUES('$dz_name','дз','-1','-','$st_id','$nt')");
        $result1=$mysql->query("SELECT * FROM `work` WHERE 1 order by `id_work` desc limit 1");
        $last_id= $result1 -> fetch_assoc();
        //id работы
        $id_last=$last_id['id_work'];
        $result2=$mysql->query("SELECT * FROM lesson WHERE type_lesson='$typel' AND name_lesson='$lecture'");
        $lesson_id= $result2 -> fetch_assoc();
        $id_lesson=$lesson_id['id_lesson'];
        $mysql->query("INSERT INTO `material`(`link`, `id_lesson`,`id_work`) VALUES('$file','$id_lesson','$id_last')");
        $result3=$mysql->query("SELECT * FROM `material` WHERE 1 order by `id_material` desc limit 1");
        $material_id= $result3 -> fetch_assoc();
        //id материала
        $id_material=$material_id['id_material'];
        $mysql->query("INSERT INTO `has`(`id_material`, `id_lesson`) VALUES('$id_material','$id_lesson')");
        $mysql->close();
        if( $laba==1){
             $laba=2;
            header('Location: laba.php');
        }else{
            header('Location: seminar.php');
        }
    }else {
        $_SESSION['file_dz_status']=0;
        if( $laba==1){
             $laba=2;
            header('Location: laba.php');
        }else{
            header('Location: seminar.php');
        }
    }
?>