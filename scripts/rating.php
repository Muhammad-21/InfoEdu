<?php
$mysql=new mysqli('localhost','root','','InfoEdu');
$result=$mysql->query("SELECT user.last_name,user.name,user.middle_name,WORK.assessmeent,user.id_user
    FROM work
    JOIN student on work.id_student=student.id_student
    JOIN user on student.id_user = user.id_user
    WHERE work.work_type = 'Курсовая'
    ORDER BY work.assessmeent DESC");
$assessments= $result -> fetch_assoc();
$id=$_SESSION['id_user'];
$res=$mysql->query("SELECT user.last_name,user.name,user.middle_name,WORK.assessmeent,user.id_user
    FROM work
    JOIN student on work.id_student=student.id_student
    JOIN user on student.id_user = user.id_user
    WHERE work.work_type = 'Курсовая' AND user.id_user='$id'
    ORDER BY work.assessmeent DESC");
$assess= $res -> fetch_assoc();
$my_assessment = $assess['assessmeent'];
?>