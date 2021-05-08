<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>InfoEdu</title>
</head>
<body>
        <img src="./img/logo.png" alt="logo_mephi" style="margin-left:35%;">
        <div class="container"">
        <div style=" margin-left: 20%;margin-right: 20%;">
        <h4 style="margin-left:5%;">Доступ к информационно-образовательному порталу</h4><br>
        <form  style="margin-left: 20%; margin-right: 20%;" action="student.php" method="GET">
          <input type="text" class="form-control" name="login"  placeholder="Логин" required><br>
          <input type="password" class="form-control" name="pass"  placeholder="Пароль" required><br>
          <button class="btn btn-primary" type="submit" style="width: 100%;">Войти</button>
        </form>
        <br><br>
        </div>
        <p class="mt-5 mb-3 text-muted" style="padding-left: 47%;">© 2021</p>
    </div>
</body>
</html>