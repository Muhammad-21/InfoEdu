<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Личный кабинет</title>
</head>
<body>
    <?php require 'blocks/header.php'?>

    <!-- Информация о студенте -->
    <div data-person="person">
        <img src="<?php if($_SESSION['user_sex'] == '1'){
            echo "./img/person.jpg";
        }else{
            echo "./img/personw.jpg";
        }?>" alt="person" width="100px" style=" margin-left: 24%; margin-top:5%;">
        <div style="color: Navy; margin-left:33%; margin-top:-7%; position:absolute;">
            <div>Имя: <?php echo $_SESSION['user_name']?></div>
            <div>Фамилия: <?php echo $_SESSION['user_last_name']?></div>
            <div>Отчество: <?php echo $_SESSION['user_middle_name']?></div>
            <div>Номер группы: <?php echo $_SESSION['group_number']?></div>
        </div>
    </div>

    <!-- Раздел мои курсы -->
    <div data-course="courses">
    <h4 style="margin-top:5%; color:Navy; margin-left:15%;">Все курсы</h4>
    <p style="border: 5px solid Navy; padding: 40px; margin-left:15%;margin-right:15%;">
        <a href="oait.php" style="color:black;" >Основы автоматизированных информационных технологий.</a>
        <span style="color: Navy;">Тихомирова Д.В.</span>
    </p>
    </div>
    <?php require 'scripts/rating.php'?>
    <!-- Раздел рейтинг -->
    <div data-rating="rating">
        <h3 style="margin-left: 15%; margin-top:5%;" ><span>Рейтинг по всем курсам</span></h3>
        <h5 style="margin-left: 15%;" >Ваш средний балл: <?php echo $my_assessment?></h5>
       <div style="border: 3px solid Navy; padding: 40px; margin-left:15%;margin-right:15%;">
            <div data-id="loader"><img src="./img/loading.gif" style="width:6%;"alt="loader">Загружаем рейтинг</div>
            <div data-block="block">
            <div style="background: Navy; color:white;">
        
            <div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm" style="font-size: 20px;">
                <div style="margin-left: 5%;">Имя</div>
                <div style="margin-left: 68%;">Средний балл</div>
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
    $mysql->close();
    ?>
    <script src="./js/header.js"></script>
</body>
</html>