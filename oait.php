<?php
session_start();
require 'exit/exit.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>ОАИТ</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="./student.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="./student.php">Главная</a>
    <div  data-id="rating" class="btn"   style="color: white;">Рейтинг</div>
    <a class="btn" style="color: white; position:absolute; margin-left:75%; bottom:90%;" href="student.php">Вернуться назад</a>
    </nav>
</div>
</div>
</div>
    <div style="margin-left: 10%;margin-top:10%;" data-lesson="lesson">
        <h5>Тип занятии</h5>
        <div><span style="background:#004d40;color:white;"> Лекции </span><a href="lecture.php" style="color:#004d40;">Основы автоматизированных информационных технологий.</a></div><br>
        <div><span style="background:#880e4f;color:white;"> Практические занятии </span><a href="seminar.php" style="color:#880e4f;">Основы автоматизированных информационных технологий.</a></div><br>
        <div><span style="background:#0d47a1;color:white;"> Лабораторные работы </span><a href="laba.php" style="color:#0d47a1;">Основы автоматизированных информационных технологий.</a></div><br>
    </div>


    <?php require 'scripts/rating.php'?>
    <!-- Раздел рейтинг -->
    <div data-rating="rating">
        <h3 style="margin-left: 15%; margin-top:5%;" ><span>Рейтинг по курсу</span></h3>
        <h5 style="margin-left: 15%;" >Ваш балл по курсу: <?php echo $my_assessment?></h5>
       <div style="border: 3px solid Navy; padding: 40px; margin-left:15%;margin-right:15%;">
            <div data-id="loader"><img src="./img/loading.gif" style="width:6%;"alt="loader">Загружаем рейтинг</div>
            <div data-block="block">
            <div style="background: Navy; color:white;">
        
            <div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm" style="font-size: 20px;">
                <div style="margin-left: 5%;">Имя</div>
                <div style="margin-left: 76%;">Балл</div>
            </div>
            </div>
            <?php
            do{
            ?>
                <div style="border: 0.5px solid Navy; "></div>
                <br>
                <p style="margin-left: 4%;font-size: 18px;"> <?php echo $assessments['name']," ",$assessments['last_name']," ",$assessments['middle_name'];
                if($assessments['id_user']==$_SESSION['id_user']){
                ?>
                <img src="img/you.svg" style="width: 18px;"><?php
                }
                ?>
                <div style="margin-left: 85%; margin-top:-6%;font-size: 18px;"><?php echo $assessments['assessmeent']?></div></p>
            <?php }
            while($assessments= $result -> fetch_assoc());
            ?>
        </div>
       </div>
    </div>

    <?php require 'blocks/footer.php';
    $mysql->close();?>
    <script src="./js/oait_student.js"></script>
</body>
</html>