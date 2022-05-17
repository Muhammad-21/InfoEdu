<?php
session_start();
$id_sender=$_SESSION['id_user'];
$id_recipient=$_SESSION['id_recipient'];
$mysql=new mysqli('127.0.0.1','root','','InfoEdu');
$sql=$mysql->query("SELECT * FROM `messages` order by `id`");
$res= $sql -> fetch_assoc();
?>
<script>
    // setTimeout("window.location.reload()",3000);//Обновление раз в 5 секунд
</script>

<?php
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
?>