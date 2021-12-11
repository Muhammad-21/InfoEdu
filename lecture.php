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
    <title>Лекции</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="./student.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="./student.php">Главная</a>
    <a class="btn" style="color: white; position:absolute; margin-left:70%; bottom:90%;" href="oait.php">Вернуться назад</a>
    </nav>
</div>
</div>

<div style="border: 3px solid Navy;margin:5%;"><br>
<span style="font-size: 16px;margin-left:15%;color: Navy; ">Материалы для подготовки</span><br>
    <?php 
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $result=$mysql->query("SELECT * 
    FROM material
    JOIN work on material.id_work=work.id_work
    LEFT JOIN lesson on material.id_lesson = lesson.id_lesson
    WHERE work.work_type='лекция'
    ORDER BY material.id_lesson");
    $materials= $result -> fetch_assoc();
    if(count($materials)>0){
    do
    {
        $path="../lecture/".$materials['link'];
        ?><div data-id="del" style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;color:white;">
        <a data-id = "link" style="border:0px;" class="btn-outline-success btn" href="<?php echo $path?>"><?php echo $materials['name_lesson'].' '.$materials['work_name']?></a><br>
        </div><?php
    }
    while($materials= $result -> fetch_assoc());
    $mysql->close();
    }else{
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;"><span>пусто</span></div><?php
    }
    ?>
    <br><br></div>
    <?php require 'blocks/footer.php';?>
</body>
</html>