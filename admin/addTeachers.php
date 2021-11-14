<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Добавления групп</title>
</head>
<body>
<div style="margin-top:10%;">
    <h4 class="container">Добавление нового преподавателя |<a href="admin.php"> вернуться назад</a></h4>
</div>
<div style="margin-top:3%; border:1px solid black;"class="container">
  <form method="POST" action="addStudents.php"><br>
  <div style="margin-left:10%" class="form-row">
    <div class="col-md-4 mb-3">
        <label for="name">Имя</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Введите ваше имя"  required>
    </div>
    <div style="margin-left:15%" class="form-group">
        <label for="groupNumber">Выбирите номер группы</label>
        
    </div>
  </div>

  <div style="margin-left:10%" class="form-row">
    <div class="col-md-4 mb-3">
      <label for="lastName">Фамилия</label>
      <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Введити вашу фамилию" required>
    </div>
    <div style="margin-left:15%" class="col-md-4 mb-3">
      <label for="login">Логин</label>
      <input type="text" class="form-control" name="login" id="login" placeholder="Придумайте логин" required>
    </div>
  </div>

  <div style="margin-left:10%" class="form-row">
    <div class="col-md-4 mb-3">
      <label for="middleName">Отчество</label>
      <input type="text" class="form-control" name="middleName" id="middleName" placeholder="Введити ваше отчество" required>
    </div>
    <div style="margin-left:15%" class="col-md-4 mb-3">
      <label for="password">Пароль</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Придумайте пароль" required>
    </div>
  </div>
    <div style="margin-left:9%" class="col-md-4 mb-3">
      <label for="numberCard">Номер зачётки</label>
      <input type="text" class="form-control" name="numberCard" id="numberCard" placeholder="Введити номер зачетки" required>
    </div>
    
   
    <div style="margin-left:10%"class="form-group row">
      <div class="">
        <button type="submit" class="btn btn-dark">Регистрация</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>