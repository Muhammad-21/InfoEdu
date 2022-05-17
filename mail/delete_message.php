<?php 
$messBox = json_decode($_POST['messages']);
$mysql=new mysqli('127.0.0.1','root','','InfoEdu');
for($i=0;$i<=count($messBox);$i++){
    $id = $messBox[$i];
    $mysql->query("DELETE FROM `messages` WHERE `id`='$id'");
}
$mysql->close();

?>