<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>ОАИТ</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="./teacher.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="./teacher.php">Главная</a>
    <a class="btn" style="color: white; position:absolute; margin-left:75%; bottom:90%;" href="teacher.php">Вернуться назад</a>
    </nav>
</div>
</div>
    <div style="margin-left: 10%;margin-top:10%;">
        <h5>Тип занятии</h5>
        <?php if($_SESSION['teacher_post'] == "Лектор")
        {
         ?> <div><span style="background:#004d40;color:white;"> Лекции </span><a href="lecture.php" style="color:#004d40;">Основы автоматизированных информационных технологий.</a></div><br> <?php
        } elseif ($_SESSION['teacher_post']=="Семинарист"){
          ?> <div><span style="background:#880e4f;color:white;"> Практические занятии </span><a href="seminar.php" style="color:#880e4f;">Основы автоматизированных информационных технологий.</a></div><br> <?php
        } else {
          ?><div><span style="background:#0d47a1;color:white;"> Лабораторные работы </span><a href="laba.php" style="color:#0d47a1;">Основы автоматизированных информационных технологий.</a></div><br><?php
        }
        ?>
    </div>
    <?php require '../blocks/footer.php' ?>
</body>
</html>