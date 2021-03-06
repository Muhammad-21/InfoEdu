<? 
  $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
  $results=$mysql->query("SELECT * From `group`");
  $group=$results->fetch_assoc();
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
    <title>Добавления групп</title>
</head>
<body>
<div style="margin-top:10%;">
    <h4 class="container">Добавление учебного плана |<a href="admin.php"> вернуться назад</a></h4>
</div>

<!-- добавление курсов -->
<div style="margin-top:3%; border:1px solid black;" class="container">
  <form method="POST" action="scripts/addStudyPlan.php" enctype="multipart/form-data"><br>
    <div class="form-group row">
    <label for="groupNumber" class="col-sm-2 col-form-label">Номер группы</label>
      <div class="col-sm-5">
        <select id="groupNumber" name="groupNumber" class="custom-select" required>
            <option selected disabled>Номер группы</option>
            <?php 
                do{
                    echo '<option>'.$group['group_number'].'</option>';
                }
                while($group=$results->fetch_assoc());
                $mysql->close();
            ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <label for="description" class="col-sm-2 col-form-label">Изображение</label>
      <div class="col-sm-5">
        <input type="file" name="file">
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