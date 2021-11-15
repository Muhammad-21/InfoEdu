<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Администрация</title>
</head>
<body>
<!-- Header -->
    <div style="background-color: black ;">
        <div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
            <a class="p-2 text-dark" href="../admin/admin.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
            <nav class="my-2 my-md-0 me-md-3" >
                <a class="btn" style="color: white;" href="../admin/admin.php">Главная</a>
            </nav>
            <a class="btn" style="color: white;" href="../exit.php">Выход</a>
        </div>
    </div>
    <div style="margin-top: 10%;" class="form-row">
    <div style="margin-left:20%; ">
        <div >&mdash; <a href="#">Пользователи ситемы</a></div>
        <div >&mdash; <a href="addGroups.php">Добавить группу</a></div>
        <div >&mdash; <a href="addUsers.php">Добавить пользователей</a></div>
        <div >&mdash; <a href="addCourses.php">Добавить курс</a></div>
    </div>
    <div style="margin-left:10%; border-left: 2px solid black;""></div>
    <div style="margin-left:10%;">
        <div >&mdash; <a href="">Список групп</a></div>
        <div >&mdash; <a href="">Список студентов</a></div>
        <div >&mdash; <a href="">Список преподавателей</a></div>
        <div >&mdash; <a href="">Список курсов</a></div>
    </div>
    </div>
<!-- Footer -->
    <div class="border-top" style="margin-top:5%;margin-left:10%;margin-right:10%;">
        <div style="margin:5%;">
            <small>© 2021</small>
        </div>
    </div>
</body>
</html>