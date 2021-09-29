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
        $mysql=new mysqli('localhost','root','','InfoEdu');
        $results=$mysql->query("SELECT * From user ORDER BY last_name");
        $us=$results->fetch_assoc();
            do{ if($us['id_user']!=25 && $us['id_user']!=$user_id){
              $id = $us['id_user'];
              $co = $mysql->query("SELECT * FROM `teacher` WHERE `id_user` = '$id'");
              $count = $co -> fetch_assoc();
              if($count){
                $type = 'преподаватель';
              }
        ?>
              <div style="display: grid; grid-template-columns:70px 300px 50px;border: 1px solid #dfe4e9;padding:1%; color:navy; margin-left:15%;margin-right:15%;">
                  <div>
                    <img style="border-radius:100px; box-shadow:0 0 15px #666; width:60px;" src="<?php echo '../img/users/'.$us['photo_link']?>" alt="фотография профиля">
                  </div>
                  <div>
                    <a href="../account/accounts.php?user_id=<?php echo $us['id_user'];?>" style="color: navy;"> <?php echo $us['last_name'].' '.$us['name'].' '.$us['middle_name']?></a><br>
                    <div class="badge-secondary badge" style="font-size:10px;"><?php echo $type;$type='';?></div>
                  </div>
                  <a class="btn-lg" style="color: white;background-color:navy; box-shadow:0 0 15px #666; border-radius:100px;padding:30%;" href="../mail/mail.php?user_id=<?php echo $us['id_user'];?>">&#9993</a>
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