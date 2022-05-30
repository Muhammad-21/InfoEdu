<?php 
    header('Content-Type: text/html; charset= utf-8');
    $groupNumber=filter_var(trim($_POST['groupNumber']),FILTER_SANITIZE_STRING);
    $name1=time().$_FILES['file']['name'];
    $name=iconv("utf-8", "cp1251", $name1);
    if(move_uploaded_file($_FILES['file']['tmp_name'],'../../img/study_plan/'.$name)){
        $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
        $results=$mysql->query("SELECT `id_group` From `group` WHERE `group_number`='$groupNumber'");
        $id=$results->fetch_assoc();
        $id_group = $id["id_group"];
        $mysql->query("INSERT INTO `study_plan` (`photo_url`,`id_group`) VALUES('$name','$id_group')");
        $mysql->close();
        header('Location: ../addStudyPlan.php');   
    }else{
        header('Location: ../addStudyPlan.php');   
    }
?>