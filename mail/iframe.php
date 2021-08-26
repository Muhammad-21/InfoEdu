<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script>
        // setTimeout("window.location.reload()",3000);//Обновление раз в 5 секунд
    </script>
</head>
<body>
    
<!-- <iframe  style="border-radius:10px; box-shadow:0 0 15px #666;"  width="420" height="450" src="send_message.php">Чат</iframe> -->
<?php
$id_sender=$_SESSION['id_user'];
$id_recipient=$_SESSION['id_recipient'];
$mysql=new mysqli('localhost','root','','InfoEdu');
if(isset($_POST['message']) && $_POST['message']!=''){
    $message=filter_var(trim($_POST['message']),FILTER_SANITIZE_STRING);
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $mysql->query("INSERT INTO `messages`(`id_sender`,`id_recipient`,`message`) VALUES('$id_sender','$id_recipient','$message')");
}
$sql=$mysql->query("SELECT * FROM `messages` order by `id`");
$res= $sql -> fetch_assoc();

do{
    if($res['id_sender']==$id_sender && $res['id_recipient']==$id_recipient){
        echo '<small style="color:navy;">Вы</small>';
        echo '<div style="margin-left:5%;">'.$res['message'].'</div><br>';
    }elseif($res['id_sender']==$id_recipient && $res['id_recipient']==$id_sender){
        echo '<small style="color:navy;">'.$_SESSION['recipient_name'].'</small><br>';
        echo '<div style="margin-left:5%;">'.$res['message'].'</div><br>';
    }
}
while($res=$sql -> fetch_assoc());
// ?>
</body>
<script>
</script>
</html>
