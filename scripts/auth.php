<?php
session_start();
header('Content-Type: text/html; charset= utf-8');
//логин и пароль из ввода
$login=filter_var(trim($_GET['login']),FILTER_SANITIZE_STRING);
$pass=filter_var(trim($_GET['pass']),FILTER_SANITIZE_STRING);
//подключения к бд
$mysql=new mysqli('localhost','root','','InfoEdu');

$result=$mysql->query("SELECT * FROM `user` WHERE `login`='$login' AND `password`='$pass'");
$user= $result -> fetch_assoc();

//данные пользователя
$id_user = $user['id_user'];
if($_SESSION){
    ?><h1 style="margin-left:30%; margin-top:20%; color:navy;">Выйдите из другого аккаунта!</h1><br>
    <a  style="margin-left:65%; margin-top:30%;font-size:30px; color:red;"href="/">назад</a>
    <?php
    exit();
}

//Проверка на одобрение
if($user['status'] == '0'){
    ?><h1 style="margin-left:25%; margin-top:20%; color:navy;">Администратор ещё не подтвердил ваш аккаунт.<br>Пожалуйста ждите ответа от администратора.</h1><br>
    <a  style="margin-left:75%;font-size:30px; color:red;"href="/">назад</a>
    <?php
    exit();
}
$student=$mysql->query("SELECT * FROM `student` WHERE `id_user`='$id_user'");
$student_id= $student -> fetch_assoc();
$_SESSION['id_student']=$student_id['id_student'];
$_SESSION['id_user']=$id_user;
$_SESSION['user_name']=$user['name'];
$_SESSION['user_last_name']=$user['last_name'];
$_SESSION['user_middle_name']=$user['middle_name'];
$_SESSION['user_sex']=$user['sex'];
$course_array = array();
$res_teach=$mysql->query("SELECT * FROM `teacher` WHERE `id_user`='$id_user'");
$teacher= $res_teach -> fetch_assoc();
$id_teacher = $teacher['id_teacher'];
$_SESSION['id_teacher']=$id_teacher;
//проверка данных на правильность
if(count($user) == 0){
    $_SESSION['nous'] = 1;
    $mysql->close();
    header('Location: /index.php');
}elseif($user['id_user'] == 26){
    header('Location: /admin/admin.php');
}elseif (count($teacher['id_teacher']) == 1){
//запрос вывод всех курсов преподавателя
$teaches=$mysql->query("SELECT *
    FROM course 
    JOIN teaches on course.id_course=teaches.id_course
    WHERE teaches.id_teacher = '$id_teacher'");
$courses= $teaches -> fetch_assoc();

//добавления в массив всех курсов 
    do
    {
        array_push($course_array,$courses['course_name']);
    }
    while($courses= $teaches -> fetch_assoc());
    
    $_SESSION['course_array']=$course_array;
    $_SESSION['post']=$teacher['post'];
    $teach=$mysql->query("SELECT * FROM `teaches` WHERE `id_teacher`='$id_teacher'");
    $teach_post= $teach -> fetch_assoc();
    $_SESSION['teacher_post']=$teach_post['post'];

    $mysql->close();
    header('Location: /teacher/teacher.php');
} else {
    $_SESSION['group_number'] = 'Б18-504';
    $mysql->close();
    header('Location: /student.php');
}
//setcookie('user', $user['name'], time() + 480,"user.php");
?>
