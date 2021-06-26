<?php
  session_start();
  // echo $_NOUS;
  // session_unset();
?>
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
<div style="border: 100px solid Navy; padding: 30px; background:white on white;">
        <img src="./img/logo.png" alt="логотип InfoEdu" style="margin-left:31%;">
        <div class="container"">
        <div style=" margin-left: 20%;">
        <h4>Доступ к информационно-образовательному порталу</h4><br>
        <div style="color: red; margin-left:18%;">
        <?php 
        if ($_SESSION['nous'] == 1){
          echo "<strong>Неверное имя пользователя и пароль.</strong><br>";
          session_unset();
        }
        ?>
        </div>
        <form  style="margin-left: 10%; margin-right: 30%;" action="scripts/auth.php" method="GET">
          <input type="text" class="form-control" name="login"  placeholder="Логин" required><br>
          <input type="password" class="form-control" name="pass"  placeholder="Пароль" required><br>
          <button class="btn btn-primary" type="submit" style="width: 100%;">Войти</button>
        </form>
        </div>
        <p class="mt-5 mb-3 text-muted" style="padding-left: 47%;">© 2021</p>
    </div>
</div>
</body>
</html>