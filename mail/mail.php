<?php 
session_start();
require '../exit/exit.php';
$id_recipient=filter_var(trim($_GET['user_id']),FILTER_SANITIZE_STRING);
$name=filter_var(trim($_GET['name']),FILTER_SANITIZE_STRING);
if($name and $id_recipient){
    $_SESSION['recipient_name']=$name;
    $_SESSION['id_recipient']=$id_recipient;
}else{
    $_SESSION['recipient_name']=null;
    $_SESSION['id_recipient']=null;
    $dis = 'disabled';
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
    <title></title>
</head>
<body style="background-color: Gainsboro;">
<div style="background-color: black ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="<?php echo $path?>" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="<?php echo $path?>">Главная</a>
    </nav>
</div>
</div>
<div style="display: grid; grid-template-columns:435px 700px 100px;">
    
    <!-- блок сообщений -->
    <div style="margin-top:5%;">
        <div style="border: 1px solid white;border-radius:5px; background:white; margin-left:2%;">
        <?php
        $id_sender=$_SESSION['id_user']; 
        $mysql=new mysqli('localhost','root','','InfoEdu');
        $sql=$mysql->query("SELECT * FROM messages WHERE id_sender =$id_sender or id_recipient=$id_sender ORDER BY id DESC");
        $res= $sql -> fetch_assoc();
        $all_messages = [];
        $messages =[];
    
        do{
            array_push($all_messages,$res);
        }
        while ($res= $sql -> fetch_assoc());
    
        $summ_keys = [];
        for($j=0; $j<count($all_messages); $j++){
            if(!$summ_keys[$all_messages[$j]['id_sender']+$all_messages[$j]['id_recipient']]){
                $messages[] = [
                    'id' => $all_messages[$j]['id'],
                    'id_sender' => $all_messages[$j]['id_sender'],
                    'id_recipient' => $all_messages[$j]['id_recipient'], 
                    'message' => $all_messages[$j]['message'],
                    'time' => $all_messages[$j]['time']
                ]; 
                $summ_keys[$all_messages[$j]['id_sender']+$all_messages[$j]['id_recipient']]=1;
            }
        }
        for($i=0;$i<count($messages);$i++){ 
                if($messages[$i]['id_sender'] == $_SESSION['id_user']){
                    $id_user=$messages[$i]['id_recipient'];
                }else{
                    $id_user=$messages[$i]['id_sender'];
                }
                $sqll=$mysql->query("SELECT * FROM user WHERE id_user=$id_user");
                $result= $sqll -> fetch_assoc();
                if($id_recipient != $id_user){
                    $class = 'btn-outline-dark btn';
                }else{
                    $class = 'btn-dark btn';
                }
        ?>
        <div style="border: 1px solid black;"></div>
        <button onclick="location.href='../mail/mail.php?user_id=<?php echo $id_user.'&name='.$result['name']?>'" class="<?php echo $class ?>" style="border: none;">
            <div  style="display: grid; grid-template-columns:50px 350px;" >
            <div>
                <img style="border-radius:100px; width:50px;" src="../img/users/<?php echo $result['photo_link'];?>" alt="фотография профиля">
            </div>
            <div align="left">
                <strong style="margin-left: 5%;"><?php echo $result['last_name'].' '.$result['name'].' '.$result['middle_name'];?></strong>
                <div style="margin-left: 6%; font-size:15px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $messages[$i]['message'];?></div>
                <div style="margin-left: 70%;font-size:10px;" class="badge-dark badge"><?php echo $messages[$i]['time'];?></div>
            </div>
            </div>
        </button>
        <div style="border: 1px solid black;"></div>
        <?php } ?>
        </div>
    </div>

    <!-- блок чата -->
    <div style="margin-left:15px;"><br>
        <iframe  width="570" height="480" name='chatWindow' id="chatWindow" data-id='chatWindow' src='iframe.php' >Чат</iframe>
        <form onsubmit="this.submit(); this.reset(); return false;" data-click="clear" action='iframe.php' method='post' target='chatWindow'>
            <input style="margin-left:1%;" type='text' name='message' size="62" placeholder="  Напишите сообщение...">
            <button type="button" class="btn-dark" <?php echo $dis;?>>отправить</button>
        </form>
    </div>

    <!-- блок постов -->
    <div style="color: navy;"><br>
    </div>

</div>
<script src="../js/message/click_btn.js" ></script>
</body>
</html>