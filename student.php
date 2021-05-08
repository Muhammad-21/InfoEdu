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
        <img src="./img/person.jpg" alt="person" width="100px" style=" margin-left: 24%; margin-top:5%;">
        <div style="color: Navy; margin-left:33%; margin-top:-6%; position:absolute;">
            <div>Имя:</div>
            <div>Фамилия:</div>
            <div>Отчество:</div>
            <div>Номер группы:</div>
        </div>
    </div>

    <!-- Раздел мои курсы -->
    <div data-course="courses">
    <h4 style="margin-top:5%; color:Navy; margin-left:15%;">Все курсы</h4>
    <p style="border: 5px solid Navy; padding: 40px; margin-left:15%;margin-right:15%;">
        <a href="oait.php" style="color:black;" >Основы автоматизированных информационных технологий.</a>
        <span style="color: Navy;">Тихомирова Д.В.</span>
    </p>
    <p style="border: 5px solid Navy; padding: 40px; margin-left:15%;margin-right:15%;">
        <a href="" style="color:black;" >Безопасность жизнедеятельности.</a>
        <span style="color: Navy;">Орлова К.Н.</span>
    </p>
    </div>

    <!-- Раздел рейтинг -->
    <div data-rating="rating">
       <p style="border: 5px solid Navy; padding: 40px; margin-left:15%;margin-right:15%; margin-top:5%;">
       </p>
    </div>
    
    <?php require 'blocks/footer.php' ?>
    <script src="./js/header.js"></script>
</body>
</html>