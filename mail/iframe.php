<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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
    $d = getdate();
    $time = $d['mday'].'.'.$d['mon'].'.'.$d['year'].' '.$d['hours'].':'.$d['minutes'].':'.$d['seconds'];
    $mysql->query("INSERT INTO `messages`(`id_sender`,`id_recipient`,`message`,`time`) VALUES('$id_sender','$id_recipient','$message','$time')");
}
$sql=$mysql->query("SELECT * FROM `messages` order by `id`");
$res= $sql -> fetch_assoc();

do{
    if($res['id_sender']==$id_sender && $res['id_recipient']==$id_recipient){
    ?>
    <div align="right" style="margin:3%">
        <div class="badge-dark badge" style="font-size:9px;"><?php echo $res['time']?> </div>
        <a class="badge" target="_blank" href="../account/accounts.php?user_id=<?php echo $id_sender;?>" style="font-size:14px;color:navy;"><?php echo $_SESSION['user_name'];?></a>
        <div style="word-wrap:normal; width: 300px; font-size:smaller;"><?php echo $res['message']?> </div>
    </div>
    <?php
    }elseif($res['id_sender']==$id_recipient && $res['id_recipient']==$id_sender){
    ?>
   <div align="left" style="margin:3%">
        <a class="badge" target="_blank" href="../account/accounts.php?user_id=<?php echo $id_recipient;?>" style="font-size:14px;color:navy;"><?php echo $_SESSION['recipient_name'];?></a>
        <div class="badge-dark badge" style="font-size:9px;"><?php echo $res['time']?> </div>
        <div style="word-wrap:normal; width: 300px; font-size:smaller;"><?php echo $res['message']?></div>
   </div>
   <?php
    }
}
while($res=$sql -> fetch_assoc()); 
?>
</body>
<script>
    window.scrollTo(0, document.body.scrollHeight);
</script>
</html>
