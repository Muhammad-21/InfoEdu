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
<div style="border: 181px solid Navy; border-style:inset;  padding: 20px 0 20px 0; background:white on white;">
  <div style="display: flex;">
    <div style="display:flex; width:350px;margin-left: 80px;margin-top:70px">
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="150" fill="navy" class="bi bi-display" viewBox="0 0 16 16">
          <path d="M0 4s0-2 2-2h12s2 0 2 2v6s0 2-2 2h-4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75c.167-.333.25-.833.25-1.5H2s-2 0-2-2V4zm1.398-.855a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3H2c-.325 0-.502.078-.602.145z"/>
        </svg>
      </div>
      <div style="font-family: Century Gothic;">
        <div style=" font-size: 50px; margin: 10% 0 0 6%;">InfoEdu</div>
        <div style="font-size: 16px;" align="center">НИЯУ МИФИ</div>
      </div>
    </div>
  <div style="border-left: 3px solid navy; margin-left:80px;">
        <div class="container">
        <br><div style="font-size:24px; font-family: Century Gothic; padding-left:30%;">Добро пожаловать!</div>
        <div style="color: red; margin-left:18%;">
        <?php 
        if ($_SESSION['nous'] == 1){
          echo "<strong>Неверное имя пользователя и пароль.</strong><br>";
          session_unset();
        }
        ?>
        </div>
        <form style="margin:10% 0 10% 8%; width:400px" action="scripts/auth.php" method="GET">
          <div class="input-group md-5">
            <div class="input-group-prepend">
              <span style="color:white; background:navy; opacity:80%"" class="input-group-text" id="login">Логин</span>
            </div>
            <input type="text" class="form-control" name="login" aria-describedby="login" required>
          </div>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span style="color:white; background:navy; opacity:80%" class="input-group-text" id="pass">Пароль</span>
            </div>
            <!-- <div class="password"> -->
              <input type="password" id="password-input" class="form-control" width="100%" name="pass" aria-describedby="pass" required>
              <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
            <!-- </div> -->
          </div>
          <div style="display: flex; justify-content:space-between;">
            <button class="btn btn-primary" type="submit" style=" width:200px;background:navy; opacity:90%">Войти</button>
            <a class="btn btn_reg" href="regist/regist.php">Регистрация</a>
          </div>
        </form>
    </div>
      </div>
  </div>
  <p class="mt-5 mb-3 text-muted" style="padding-left: 47%;">© 2021</p>
</div>
<script src="./js/show_password.js"></script>
</body>
<style>
  .btn_reg{
    margin-left:50px; 
    width:120px;
    border: 1px solid navy;
    color:navy; 
    text-decoration: none;
  }
  .btn_reg:hover{
    color:white;
    background-color: navy;
  }
  .password {
	  position: relative;
  }
.password-control {
	position: absolute;
	top: 14px;
	right: 6px;
	display: inline-block;
	width: 20px;
	height: 15px;
  z-index: 100;
  background: url(https://snipp.ru/demo/495/view.svg) 0 0 no-repeat;
}
.password-control.view {
	background: url(https://snipp.ru/demo/495/no-view.svg) 0 0 no-repeat;
}
</style>
</html>