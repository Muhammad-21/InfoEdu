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
    <h4 class="container">Добавление новых студентов |<a href="admin.php"> вернуться назад</a></h4>
</div>
<div style="margin-top:3%; border:1px solid black;"class="container">
  <form method="POST" action="scripts/addGroups.php"><br>
    <div class="form-group row">
      <label for="inputGroupNumber" class="col-sm-2 col-form-label">Номер группы</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="inputGroupNumber" placeholder="номер группы" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="inputGroupName" class="col-sm-2 col-form-label">Специальность</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" id="inputGroupName" placeholder="специальность" required>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-2 col-sm-10">
        <button type="submit" class="btn btn-dark">Добавить</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>