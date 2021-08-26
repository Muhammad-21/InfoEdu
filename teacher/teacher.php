<?php
session_start();
$user_id=$_SESSION["id_user"];
if($_SESSION['img_status']==1){
    $err="Тип файла несоответсвует";
    $e=1;//помощьник
}elseif($_SESSION['img_status']==-1){
    $err="Произошла неизвестная ошибка";
    $e=1;
}
$mysql=new mysqli('localhost','root','','InfoEdu');
$res=$mysql->query("SELECT * From user WHERE user.id_user=$user_id");
$mail=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Личный кабинет</title>
</head>
<body>
    <?php require '../blocks/teacher_header.php'?>

    <img data-id="loader" src="../img/loading.gif" style="width:40%; margin-left:28%; display:none;"alt="loader">

    <!-- Информация о преподавателе -->
    <div data-person="person">
        <form method="POST" action="../load_img.php" enctype="multipart/form-data" style="margin-left: 24%; margin-top:5%;">
            <label class="custom-file-upload">
                <input name="image" style="display:none;" type="file" onchange="form.submit()"/>
                <img src="<?php echo '../img/users/'.$mail['photo_link']?>" alt="person" title="выберите фотографию" width="120px" style="border-radius:100px; box-shadow:0 0 15px #666;">
            </label>
        </form>
        <?php if($mail['photo_link']!=='personw.jpg' && $mail['photo_link']!=='person.jpg'){?>
            <a class="btn-danger btn" style="margin-left:22%" href="../delete_img.php?link=<?php echo $mail['photo_link'];?>">удалить фотографию</a>
        <?php }elseif($e==1){
            ?><div style="margin-left:21%; color:red"><?php echo $err;?></div><?php
            $err='';
            $e='';
            $_SESSION['img_status']='end';
        }?>
        
        <div style="color: Navy; margin-left:38%; margin-top:-13%; ">
            <div>Имя: <?php echo $_SESSION['user_name']?></div>
            <div>Фамилия: <?php echo $_SESSION['user_last_name']?></div>
            <div>Отчество: <?php echo $_SESSION['user_middle_name']?></div>
            <?php if($mail['email']== NULL){ ?>
                <form action="../load_mail.php" method="POST">
                    Почта: 
                    <input name="mail" type="email" placeholder="example@mail.com" required>
                    <button class="btn btn-success">добавить &#9989</button>
                </form>
            <?php }else{?>
                <form action="../delete_mail.php">
                    <div>Почта: <a style="color:navy;" href="mailto:"<?php echo $mail['email']?>><?php echo $mail['email']?></a>
                    <button class="btn btn-danger">удалить &#10060</button></div>
                </form>
            <?php }?>
            <div>Должность: <?php echo $_SESSION['post']?></div>
            <div>Курсы: <br><?php for ($i=0;$i<count($_SESSION['course_array']);$i++) {echo $i+1,". ",$_SESSION['course_array'][$i],"<br>";}?></div>
        </div>
    </div>
    <!-- Раздел курсы -->
    <div data-course="courses">
    <h4 style="margin-top:5%; color:Navy; margin-left:15%;">Все курсы</h4>
    <p style="border: 5px solid Navy; box-shadow:0 0 15px #666; padding: 40px; margin-left:15%;margin-right:15%;">
        <a href="oait_teacher.php" style="color:black;" >Основы автоматизированных информационных технологий.</a>
    </p>
    </div>


    <!-- Раздел пользователи системы-->
    <div data-id="us"><br>
        <div>
        <?php 
        $results=$mysql->query("SELECT * From user");
        $us=$results->fetch_assoc();
            do{ if($us['id_user']!=25 && $us['id_user']!=$user_id){?>
              <div style="border: 1px solid #dfe4e9;padding:2%; color:navy; margin-left:10%;margin-right:10%;">
                <img style="border-radius:100px; box-shadow:0 0 15px #666; width:80px;" src="<?php echo '../img/users/'.$us['photo_link']?>" style="width:6%;"alt="фотография профиля">
                  <a target="_blank" href="../account/accounts.php?user_id=<?php echo $us['id_user'];?>" style="color: navy;"> <?php echo $us['last_name'].' '.$us['name'].' '.$us['middle_name'].'</a>'.' '.'<a class="btn-lg" style="color: white;background-color:navy; box-shadow:0 0 15px #666; border-radius:100px;" target="_blank" href="../mail/mail.php?user_id='.$us['id_user'].'&name='.$us['name'].'">'.'&#9993</a>'.'<br>';}?>
              </div>
              <?php
            }
            while ($us=$results->fetch_assoc());
        ?>
        </div>
    </div>


    <?php  $mysql->close();
    require '../blocks/footer.php'; ?>
    <script src="../js/teacher_header.js"></script>
</body>
<style>
    .custom-file-upload{
        cursor: pointer;
    }
</style>
</html>