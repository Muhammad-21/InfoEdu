<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Личный кабинет</title>
</head>
<body>
    <?php require '../blocks/teacher_header.php'?>

    <!-- Информация о преподавателе -->
    <div data-person="person">
        <img src="<?php if($_SESSION['user_sex'] == '1'){
            echo "../img/person.jpg";
        }else{
            echo "../img/personw.jpg";
        }?>" alt="person" width="100px" style=" margin-left: 24%; margin-top:5%;">
        <div style="color: Navy; margin-left:33%; margin-top:-7%; ">
            <div>Имя: <?php echo $_SESSION['user_name']?></div>
            <div>Фамилия: <?php echo $_SESSION['user_last_name']?></div>
            <div>Отчество: <?php echo $_SESSION['user_middle_name']?></div>
            <div>Должность: <?php echo $_SESSION['post']?></div>
            <div>Курсы: <br><?php for ($i=0;$i<count($_SESSION['course_array']);$i++) {echo $i+1,". ",$_SESSION['course_array'][$i],"<br>";}?></div>
        </div>
    </div>

    <!-- Раздел курсы -->
    <div data-course="courses">
    <h4 style="margin-top:5%; color:Navy; margin-left:15%;">Все курсы</h4>
    <p style="border: 5px solid Navy; padding: 40px; margin-left:15%;margin-right:15%;">
        <a href="oait_teacher.php" style="color:black;" >Основы автоматизированных информационных технологий.</a>
    </p>
    </div>
    
    <?php require '../blocks/footer.php' ?>
    <script src="../js/teacher_header.js"></script>
</body>
</html>