<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>ОАИТ</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="./teacher.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="./teacher.php">Главная</a>
    <div  data-id="student" class="btn"  style="color: white;">Студенты</div>
    <a class="btn" style="color: white; position:absolute; margin-left:60%; bottom:90%;" href="teacher.php">Вернуться назад</a>
    </nav>
</div>
</div>
  <img data-id="loader" src="../img/loading.gif" style="width:40%; margin-left:28%; display:none;"alt="loader">
    <div data-id="type_lesson" style="margin-left: 10%;margin-top:10%;">
        <h5>Тип занятии</h5>
        <?php if($_SESSION['teacher_post'] == "Лектор")
        {
         ?> <div><span style="background:#004d40;color:white;"> Лекции </span><a href="lecture.php" style="color:#004d40;">Основы автоматизированных информационных технологий.</a></div><br> <?php
        } elseif ($_SESSION['teacher_post']=="Семинарист"){
          ?> <div><span style="background:#880e4f;color:white;"> Практические занятии </span><a href="seminar.php" style="color:#880e4f;">Основы автоматизированных информационных технологий.</a></div><br> <?php
        } else {
          ?><div><span style="background:#0d47a1;color:white;"> Лабораторные работы </span><a href="laba.php" style="color:#0d47a1;">Основы автоматизированных информационных технологий.</a></div><br><?php
        }
        ?>
    </div>

    <!-- личный кабинет студентов -->
    <div data-student="students"><br>
        <?php 
          $mysql=new mysqli('localhost','root','','InfoEdu');
          $res=$mysql->query("SELECT * From student JOIN user on student.id_user=user.id_user");
          $list=$res->fetch_assoc();
            do{ if($list['id_user']!=25){?>
              <div style="border: 1px solid #dfe4e9;padding:2%; color:navy; margin-left:10%;margin-right:10%;">
                <img style="border-radius:100px; box-shadow:0 0 15px #666; width:80px;" src="<?php echo '../img/users/'.$list['photo_link']?>" style="width:6%;"alt="фотография профиля">
                  <a target="_blank" href="../account/accounts.php?user_id=<?php echo $list['id_user'];?>" style="color: navy;"> <?php echo $list['last_name'].' '.$list['name'].' '.$list['middle_name'].'</a>'.' '.'<a class="btn-lg" style="color: white;  box-shadow:0 0 15px #666; border-radius:100px; background-color:navy;" href="../mail/mail.php?user_id='.$list['id_user'].'">'.'&#9993</a>'.'<br>';}?>
              </div>
              <?php
            }
            while ($list=$res->fetch_assoc());
          $mysql->close();
        ?>
    </div>


    <?php require '../blocks/footer.php' ?>
    <script src="../js/student.js"></script>
</body>
</html>