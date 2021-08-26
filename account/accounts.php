<?php
    session_start();
    $user_id=filter_var(trim($_GET['user_id']),FILTER_SANITIZE_STRING);
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $res=$mysql->query("SELECT * FROM user JOIN student on user.id_user=student.id_user WHERE user.id_user=$user_id");
    $list=$res->fetch_assoc();
    if($list==''){
        $res=$mysql->query("SELECT * FROM user WHERE user.id_user=$user_id");
        $list=$res->fetch_assoc();
        $teach='ok';//преподаватель
    }
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
  <title><?php echo $list['last_name'].' '.$list['name'].' '.$list['middle_name']?></title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="<?php echo $path;?>" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="<?php echo $path;?>">Главная</a>
    </nav>
</div>
</div>
<br><br>
    <div data-person="person">
    <img src="<?php echo '../img/users/'.$list['photo_link']?>" alt="person"  width="120px" style="border-radius:100px; box-shadow:0 0 15px #666;margin-left:22%;">
        <div style="color: Navy; margin-left:33%; margin-top:-8%; ">
            <div>Имя: <?php echo $list['name']?></div>
            <div>Фамилия: <?php echo $list['last_name']?></div>
            <div>Отчество: <?php echo $list['middle_name']?></div>
            <?php if($teach=='ok'){
                if($list['email']!=''){?>
                    <div>Почта: <?php echo $list['email']?>
                <?php }?>
                <div>Курсы:</div>1. Основы автоматизированных информационных технологий
                <?php }else{ ?>
                <div>Номер группы: <?php echo "Б18-504"?></div>
                <?php } ?>
        </div>
    </div>
    <a target="_blank" class="btn" style="color: white; background:Navy;margin-left:22%;margin-top:2%;" href="../mail/mail.php?user_id=<?php echo $list['id_user'];?>&name=<?php echo $list['name'];?>">Написать сообщение</a>
    <?php require '../blocks/footer.php';
    $mysql->close();?>
</body>
</html>