<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mail.css">
</head>
<body style="margin: 0;">
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script> -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div style="margin:0px; height:510px" class="card chat-app chat" data-id='message_list'>
<?
$id_sender=$_SESSION['id_user'];
$id_recipient=$_SESSION['id_recipient'];
if($id_recipient == null){
    ?>
    <br><br><br><br><br><br><br><br>
    <strong align="center" style="color:black;"> Выберите, чат с сообщениями </strong>
    <?php
    exit;
}
if($id_recipient == 'empty'){
    ?>
    <br><br><br><br><br><br><br><br>
    <strong align="center" style="color:black;"> Пусто </strong>
    <?php
    exit;
}?>
                <div style="position:fixed; z-index:1; width:100%;background:white" class="chat-header clearfix">
                    <div class="row">
                        <div class="col-lg-6">
                            <a target="_blank" href="../account/accounts.php?user_id=<?php echo  $id_recipient;?>"" data-toggle="modal" data-target="#view_info">
                                <img src="../img/users/<? echo $_SESSION['photo']?>" alt="avatar">
                            </a>
                            <div class="chat-about">
                                <h6 class="m-b-0"><?php echo $_SESSION['recipient_name'];?></h6>
                                <small><div class="status"> <i class="fa fa-circle online"></i> online </div></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top:80px" class="chat-history">
                    <ul class="m-b-0">
<?php
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
$mess_num = 0;//счётчик для кол-во сообщений
do{
    if($res['id_sender']==$id_sender && $res['id_recipient']==$id_recipient){ $mess_num++;
    ?>
                        <li style="padding:15px" data-id="block"class="clearfix">
                            <div class="message-data text-right">
                                <span class="message-data-time"><?php echo $res['time']?></span>
                                <img src="../img/users/<? echo $_SESSION['user_photo']?>" alt="avatar">
                            </div>
                            <div title="отметить" id=<?php echo $res['id']?> data-id="message" style="width:500px; cursor:pointer" class="message other-message float-right"> <?php echo $res['message']?>  </div>
                        </li>
    <?php
    }elseif($res['id_sender']==$id_recipient && $res['id_recipient']==$id_sender){ $mess_num++;
    ?>
                        <li class="clearfix">
                            <div class="message-data">
                                <img src="../img/users/<? echo $_SESSION['photo']?>" alt="avatar">
                                <span class="message-data-time"><?php echo $res['time']?></span>
                            </div>
                            <div style="width:500px" class="message my-message"><?php echo $res['message']?></div>                                    
                        </li> 
   <?php
    }
}
while($res=$sql -> fetch_assoc());
$mysql->close();
?>
    </ul>
    <?
if($mess_num == 0){
    ?><br><br><br><br><br>
    <strong style="margin: 35%;" style="color:black;">Cообщений пока нет...</strong>
    <?php
} 
?>
</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="../js/message/delete.js"></script>
</html>