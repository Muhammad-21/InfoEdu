<?php 
    session_start();
    $group_id = $_SESSION['id_group'];
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $results=$mysql->query("SELECT * From `study_plan` WHERE `id_group`='$group_id'");
    $plan=$results->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <title>Учебный план</title>
</head>
<body>
    <div style="padding:15px;font-size:18px;background:#2aa493;width:140px;position:absolute;top:40px;left:20px">
        <a style="color:white;text-decoration:none" href="../student.php">< вернуться назад</a>
    </div>
    <?php if($plan['photo_url'] != ''){
    ?>
    <img style="width:100%;" src="../img/study_plan/<?php echo $plan['photo_url'] ?>" alt="учебный план"/>
    <?php
    }else{?>
        <div style="text-align:center;font-size:20px;margin-top:300px;color:#2aa493;">Учебный план еще не добавлен</div>
    <?}?>
</body>
</html>