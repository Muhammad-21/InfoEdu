<?php 
session_start();
require '../exit/exit.php';
$id_recipient=filter_var(trim($_GET['user_id']),FILTER_SANITIZE_STRING);
$name=filter_var(trim($_GET['name']),FILTER_SANITIZE_STRING);
$_SESSION['recipient_name']=$name;
$_SESSION['id_recipient']=$id_recipient;
if($_SESSION['id_student']){
    $path='../student.php';
}else{
    $path='../teacher/teacher.php';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title></title>
</head>
<body style="background-color: Gainsboro;">
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="<?php echo $path?>" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="<?php echo $path?>">Главная</a>
    </nav>
</div>
</div>
<div style="display: grid; grid-template-columns:1fr 24fr 10fr;">
    
    <!-- блок сообщений -->
    <div style="color: navy; margin-top:5%;"><br>
        <div style="border: 1px solid white; background:white; margin-left:10%;margin-right:-100%;">
        <?php
        $id_sender=$_SESSION['id_user']; 
        $mysql=new mysqli('localhost','root','','InfoEdu');
        $sql=$mysql->query("SELECT * FROM messages WHERE id_sender =$id_sender or id_recipient=$id_sender GROUP BY id_sender");
        ?>
        </div>
    </div>

    <!-- блок чата -->
    <div style="margin-left:30%;padding:1%;" ><br>
        <iframe style="border-radius:10px;"  width="590" height="480" name='chatWindow' data-id='chatWindow' src='iframe.php' >Чат</iframe>
        <form onsubmit="this.submit(); this.reset(); return false;" data-click="clear" action='iframe.php' method='post' target='chatWindow'>
            <input style="margin-left:1%;" type='text' name='message' size="65" placeholder="  Напишите сообщение...">
            <button  class="btn-primary">отправить</button>
        </form>
    </div>

    <!-- блок постов -->
    <div style="color: navy;"><br>
    </div>

</div>
</body>
</html>