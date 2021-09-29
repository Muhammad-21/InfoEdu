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
<div data-id="us"><br>
        <div>
        <?php 
        $mysql=new mysqli('localhost','root','','InfoEdu');
        $results=$mysql->query("SELECT * From user");
        $us=$results->fetch_assoc();
            do{ if($us['id_user']!=25 && $us['id_user']!=$user_id){?>
              <div style="border: 1px solid #dfe4e9;padding:2%; color:navy; margin-left:10%;margin-right:10%;">
                <img style="border-radius:100px; box-shadow:0 0 15px #666; width:60px;" src="<?php echo '../img/users/'.$us['photo_link']?>" alt="фотография профиля">
                  <a href="../account/accounts.php?user_id=<?php echo $us['id_user'];?>" style="color: navy;"> <?php echo $us['last_name'].' '.$us['name'].' '.$us['middle_name'].'</a>'.' '.'<a class="btn-lg" style="color: white;background-color:navy; box-shadow:0 0 15px #666; border-radius:100px;" href="../mail/mail.php?user_id='.$us['id_user'].'">'.'&#9993</a>'.'<br>';}?>
              </div>
              <?php
            }
            while ($us=$results->fetch_assoc());
        ?>
        </div>
    </div>
</body>
</html>