<?php 
session_start();
require '../exit/exit.php';
$id_recipient=filter_var(trim($_GET['user_id']),FILTER_SANITIZE_STRING);
$name=filter_var(trim($_GET['name']),FILTER_SANITIZE_STRING);
$photo=filter_var(trim($_GET['photo']),FILTER_SANITIZE_STRING);
if($name and $id_recipient and $photo){
    $_SESSION['recipient_name']=$name;
    $_SESSION['id_recipient']=$id_recipient;
    $_SESSION['photo']=$photo;
}else{
    $_SESSION['recipient_name']=null;
    $_SESSION['id_recipient']=null;
    $_SESSION['photo']=null;
    $dis = 'disabled';
}
if($_SESSION['id_student']){
    $path='../student.php';
}else{
    $path='../teacher/teacher.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mail.css">
    <title>Сообщения</title>
</head>
<body>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script> -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card chat-app">
            <!-- Список людей -->
            <div id="plist" class="people-list">
                <div class="back_main" onclick="location.href='<?echo $path ?>'">
                    <i class="fa fa-angle-left"></i> на главную
                </div>
                <ul style="margin-top:18px;" class="list-unstyled chat-list">

                <?php
                $id_sender=$_SESSION['id_user']; 
                $mysql=new mysqli('localhost','root','','InfoEdu');
                $sql=$mysql->query("SELECT * FROM messages WHERE id_sender =$id_sender or id_recipient=$id_sender ORDER BY id DESC");
                $res= $sql -> fetch_assoc();
                $all_messages = [];
                $messages =[];
                if(count($res) > 0){
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
                            $class = 'clearfix';
                        }else{
                            $class = 'clearfix active';
                        }
                ?>
                    <li onclick="location.href='../mail/mail.php?user_id=<?php echo $id_user.'&name='.$result['name'].'&photo='.$result['photo_link']?>'" class="<?echo $class;?>">
                        <img src="../img/users/<?php echo $result['photo_link'];?>" alt="avatar">
                        <div class="about">
                            <div class="name"><?php echo $result['last_name'].' '.$result['name'];?></div>
                            <div class="status"> <i class="fa fa-circle offline"></i> offline </div>                                            
                        </div>
                    </li>
                    <?php }
                    }else{
                        $_SESSION['recipient_name']='empty';
                        $_SESSION['id_recipient']='empty';
                    } ?>
                </ul>
            </div>
            <!-- Блок чата -->
            <div class="chat">
            <iframe style="border:none" height="510px" width="100%" name='chatWindow' id="chatWindow" data-id='chatWindow' src='iframe.php' >Чат</iframe>
                    <form onsubmit="this.submit(); this.reset(); return false;" data-click="clear" action='./iframe.php' method='POST' target='chatWindow'>
                        <div class="chat-message clearfix">
                            <div class="input-group mb-0">    
                                <input name='message' type="text" class="form-control" placeholder="Напишите сообщение...">                                    
                                <div class="input-group-prepend">
                                    <button type="button"  <?php echo $dis;?> class="input-group-text"><i class="fa fa-send"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>
</body>
</html>