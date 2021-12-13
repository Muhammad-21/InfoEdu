<? 
    $mysql=new mysqli('localhost','root','','InfoEdu');
    
    // получения преподавателей
    $results=$mysql->query("SELECT * From `user` JOIN `teacher` ON `teacher`.id_user=`user`.id_user");
    $teachers=$results->fetch_assoc();

    // получения курсов
    $result=$mysql->query("SELECT * From `course`JOIN `group` ON `group`.id_group=`course`.id_group");
    $courses=$result->fetch_assoc();

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
    <title>Добавление курсов преподователю</title>
</head>
<body>
<div style="margin-top:10%;">
    <h4 class="container">Добавление курсов преподователю |<a href="admin.php"> вернуться назад</a></h4>
</div>

<!-- добавление курсов -->
<div style="margin-top:3%; border:1px solid black;" class="container">
  <form method="POST" action="scripts/addCourseTeach.php"><br>
    <div class="form-group row">
    <label for="teacher" class="col-sm-3 col-form-label">Выберите преподавателя</label>
      <div class="col-sm-5">
        <select id="teacher" name="teacher" class="custom-select"  required>
            <option selected disabled>преподаватели</option>
            <?php 
                do{
                    echo '<option>'.'id: '.$teachers['id_teacher'].' '.$teachers['last_name'].' '.$teachers['name'].' '.$teachers['middle_name'].'</option>';
                }
                while($teachers=$results->fetch_assoc());
            ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
    <label for="course" class="col-sm-3 col-form-label">Выберите курс</label>
      <div class="col-sm-5">
        <select id="course" name="course" class="custom-select" required>
            <option selected disabled>курсы</option>
            <?php 
                do{ 
                    if($courses['elective'] == 1){
                        $elective = ' курс по выбору';
                    }else{
                        $elective = " ";
                    }
                    echo '<option>'.'id: '.$courses['id_course'].' '.$courses['course_name'].' группа '.$courses['group_number'].$elective.'</option>';
                }
                while($courses=$result->fetch_assoc());
            ?>
        </select>
      </div>
    </div>
    <div class="form-group row">
    <label for="type-lesson" class="col-sm-3 col-form-label">Тип</label>
      <div class="col-sm-5">
        <select id="type-lesson" name="type-lesson" class="custom-select" required>
            <option selected disabled>тип</option>
            <option>Лектор</option>
            <option>Семинарист</option>
            <option>Лаба</option>
        </select>
      </div>
    </div>
    <div class="form-group row">
      <div class="offset-sm-3 col-sm-10">
        <button type="submit" class="btn btn-dark">Добавить</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>