<?
    header('Content-Type: text/html; charset= utf-8');
    $id_student=filter_var(trim($_POST['id_student']),FILTER_SANITIZE_STRING);
    $id_course=filter_var(trim($_POST['id_course']),FILTER_SANITIZE_STRING);
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $mysql->query("INSERT INTO `study` (`id_student`,`id_course`) VALUES('$id_student','$id_course')");
    $mysql->close();
    header('Location: ../student.php?status=success');
?>