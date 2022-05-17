<?php
session_start();
require 'exit/exit.php';
$user_id=$_SESSION["id_user"];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Пользователи</title>
</head>
<body>
  <br>
  <h2 style="margin-left: 15%; color:navy;">Пользователи</h2><br>
  <div style="border: 3px solid navy; margin-left:15%;margin-right:15%;"></div><br>
<div data-id="us">
        <div>
        <?php 
        $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
        $results=$mysql->query("SELECT * From `user` WHERE `status`='1' ORDER BY `last_name`");
        $us=$results->fetch_assoc();
            do{ if($us['id_user']!=25 && $us['id_user']!=$user_id && $us['id_user']!=3){
              $id = $us['id_user'];
              
              $co = $mysql->query("SELECT * FROM `teacher` WHERE `id_user` = '$id'");
              $count_teacher = $co -> fetch_assoc();

              
              if($count_teacher){
                $type = 'преподаватель';
                $color = 'badge-dark badge';
              }else{
                $co_stud = $mysql->query("SELECT `group`.`group_number` 
                                            FROM `group` 
                                            JOIN `student` on `group`.`id_group`=`student`.`id_group`
                                            WHERE `student`.`id_user`='$id'");
                $count_student = $co_stud -> fetch_assoc();
                if($count_student){
                  $type = 'Студент группы '.$count_student['group_number'];
                  $color = 'badge-light badge';
                }                
              }
        ?>
              <div style="display: grid; grid-template-columns:70px 300px 50px;border: 1px solid #dfe4e9;padding:1%; color:navy; margin-left:15%;margin-right:15%;">
                  <div>
                    <img style="border-radius:100px; box-shadow:0 0 15px #666; width:60px;" src="<?php echo '../img/users/'.$us['photo_link']?>" alt="фотография профиля">
                  </div>
                  <div>
                    <a href="../account/accounts.php?user_id=<?php echo $us['id_user'];?>" style="color: navy;"> <?php echo $us['last_name'].' '.$us['name'].' '.$us['middle_name']?></a><br>
                    <div class="<?php echo $color;?>" style="font-size:10px;"><?php echo $type;$type='';?></div>
                  </div>
                  <a class="btn-lg" href="../mail/mail.php?user_id=<?php echo $us['id_user'].'&name='.$us['name']?>;?>">&#9993</a>
              </div><br>
              <?php
              }
            }
            while ($us=$results->fetch_assoc());
            ?>
        </div>
    </div>
  <div style="border: 3px solid navy; margin-left:15%;margin-right:15%;"></div><br>
</body>
</html>