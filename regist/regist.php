<?php
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $sql=$mysql->query("SELECT * FROM `group`");
    $res= $sql -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Регистрация</title>
</head>
<body>
<div style="margin-top:5%;">
    <h4 class="container">Форма для регистрации |<a href="/"> вернуться назад</a> | <a data-id="back"  href="regist.php"> вернуться к выбору</a></h4>
</div>
<div data-id="person-type">
  <h5 style="display: flex;justify-content:center;margin-top:5%;">Выберите тип пользователья:</h5>
  <div style="display: flex;justify-content:center;">
    <div style="margin-top: -2%;" class="cht student">
      <svg width="6em" height="8em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
        <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
        <div style="margin-top: -30%;font-size:20px">Студент</div>
      </svg>
    </div>

    <div style="margin-top: -2%;margin-left:5%" class="cht teacher">
      <svg style="margin-left:18%" width="6em" height="8em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
        <path fill-rule="evenodd" d="M13 7.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0v-2z"/>
        <div style="margin-top: -20%;font-size:20px">Преподователь</div>
      </svg>
    </div>
  </div>
</div>
<!-- Регистрация студентов -->
<div style="margin-top:3%; border:1px solid black;" class="container" data-id="students-reg">
  <form method="POST" action="addStudents.php"><br>
  <div style="margin-left:10%" class="form-row">
    <div class="col-md-4 mb-3">
        <label for="StudentName">Имя</label>
        <input type="text" class="form-control" id="StudentName" name="StudentName" placeholder="Введите ваше имя"  required>
    </div>
    <div style="margin-left:15%" class="form-group">
        <label for="groupNumber">Выбирите номер группы</label>
        <select id="groupNumber" name="groupNumber" class="custom-select" required>
            <option selected disabled>Номер группы</option>
            <?php 
                do{
                    echo '<option>'.$res['group_number'].'</option>';
                }
                while($res= $sql -> fetch_assoc());
                $mysql->close();
            ?>
        </select>
    </div>
  </div>
  <div style="margin-left:10%" class="form-row">
    <div class="col-md-4 mb-3">
      <label for="StudentLastName">Фамилия</label>
      <input type="text" class="form-control" name="StudentLastName" id="StudentLastName" placeholder="Введити вашу фамилию" required>
    </div>
    <div style="margin-left:15%" class="col-md-4 mb-3">
      <label for="StudentLogin">Логин</label>
      <input type="text" class="form-control" name="StudentLogin" id="StudentLogin" placeholder="Придумайте логин" required>
    </div>
  </div>
  <div style="margin-left:10%" class="form-row">
    <div class="col-md-4 mb-3">
      <label for="StudentMiddleName">Отчество</label>
      <input type="text" class="form-control" name="StudentMiddleName" id="StudentMiddleName" placeholder="Введити ваше отчество" required>
    </div>
    <div style="margin-left:15%" class="col-md-4 mb-3">
      <label for="StudentPassword">Пароль</label>
      <input type="password" class="form-control" name="StudentPassword" id="StudentPassword" placeholder="Придумайте пароль" required>
    </div>
  </div>
    <div style="margin-left:10%" class="form-row">
    <div class="col-md-4 mb-3">
      <label for="numberCard">Номер зачётки</label>
      <input type="text" class="form-control" name="numberCard" id="numberCard" placeholder="Введити номер зачетки" required>
    </div>
    <div class="form-group" style="margin-left:15%">
      <label for="StudentSex">Выбирите ваш пол</label>
        <select id="StudentSex" name="StudentSex" class="custom-select" required>
            <option selected disabled>пол</option>
                <option>мужской</option>
                <option>женский</option>
        </select>
    </div>
    </div>
    <div style="margin-left:10%"class="form-group row">
      <div class="">
        <button type="submit" class="btn btn-dark">Регистрация</button>
      </div>
    </div>
  </form>
</div>

<!-- Регистрация преподавателей -->
<div style="margin-top:3%; border:1px solid black;" class="container" data-id="teachers-reg">
  <form method="POST" action="addTeacher.php"><br>
    <div style="margin-left:10%" class="form-row">
      <div class="col-md-4 mb-3">
          <label for="name">Имя</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Введите ваше имя"  required>
      </div>
      <div style="margin-left:9%" class="col-md-4 mb-3">
        <label for="post">Должности</label>
        <input type="text" class="form-control" name="post" id="post" placeholder="Введити ваши должности" required>
      </div>
    </div>

    <div style="margin-left:10%" class="form-row">
      <div class="col-md-4 mb-3">
        <label for="lastName">Фамилия</label>
        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Введити вашу фамилию" required>
      </div>
      <div style="margin-left:9%" class="col-md-4 mb-3">
        <label for="login">Логин</label>
        <input type="text" class="form-control" name="login" id="login" placeholder="Придумайте логин" required>
      </div>
    </div>

    <div style="margin-left:10%" class="form-row">
      <div class="col-md-4 mb-3">
        <label for="middleName">Отчество</label>
        <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Введити ваше отчество" required>
      </div>
      <div style="margin-left:9%" class="col-md-4 mb-3">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Придумайте пароль" required>
      </div>
    </div>
    <div class="form-group" style="margin-left:10%;margin-right:60%">
      <label for="sex">Выбирите ваш пол</label>
        <select id="sex" name="sex" class="custom-select" required>
            <option selected disabled>пол</option>
                <option>мужской</option>
                <option>женский</option>
        </select>
    </div>
      
   
      <div style="margin-left:10%"class="form-group row">
      <div class="">
        <button type="submit" class="btn btn-dark">Регистрация</button>
      </div>
    </div>
  </form>
</div>
<script src="../js/regist.js"></script>
</body>
<style>
</style>

</html>