<?php
session_start();
require '../exit/exit.php';
if($_SESSION['id_student']){
    $path='../student.php';
}else{
    $path='../teacher/teacher.php';
}
$id_sender=$_SESSION['id_user'];
$mysql=new mysqli('localhost','root','','InfoEdu');
$sql=$mysql->query("SELECT * FROM messages WHERE id_sender =$id_sender or id_recipient=$id_sender GROUP BY id_sender");
$res= $sql -> fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Сообщения</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="<?php echo $path?>" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="<?php echo $path?>">Главная</a>
    </nav>
</div>
</div>
    <div style="margin-left:20%;"><br>
    <h1 style="color:navy;">Сообщения</h1>
    <?php
    $users=array();//массив для хранения user_id
        do{
            if($res['id_sender']==$id_sender){
                $id_recipient=$res['id_recipient'];
                array_push($users,$id_recipient);
            }else{
                $id_send=$res['id_sender'];
                array_push($users,$id_send);
            }
        }
        while($res= $sql -> fetch_assoc());
        $new_user_list = array_unique($users);//удаления дубликатов
        sort($new_user_list);
        for ($i=0;$i<count($new_user_list);$i++){
            $sql1=$mysql->query("SELECT * FROM user WHERE id_user=$new_user_list[$i]");
            $user=$sql1 -> fetch_assoc();
            ?>
            <br>
            
                <a  target="_blank" style="width:80%;" class="btn-outline-primary btn" href="../mail/mail.php?user_id=<?php echo $user['id_user'].'&name='.$user['name']?>">
                    <!-- <div class="btn-outline" style="border: 1px solid #dfe4e9;padding:2%; color:navy;margin-right:20%;"> -->
                        <div style="margin-right:60%;">
                            <img style="border-radius:100px; box-shadow:0 0 15px #666; width:50px;" src="<?php echo '../img/users/'.$user['photo_link']?>" alt="фотография профиля">
                            <?php echo $user['last_name'].' '.$user['name'].' '.$user['middle_name'].' '.'<br>';?>
                        </div>
                </a><br>
               
            <?php
        }
    ?>
    </div>
<?php require '../blocks/footer.php' ?>
</body>
</html>