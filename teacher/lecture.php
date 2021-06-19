<?php
    session_start();
    if($_SESSION['file_status']==0){
        $status='файл не выбран ❌';
        $_SESSION['file_status']=3;
    }elseif($_SESSION['file_status']==1){
        $status='файл загружен ✔';
        $color=1;
    }elseif($_SESSION['file_status']==-1){
        $status='размер файла больше 10 мб';
    }elseif($_SESSION['file_status']==-2){
        $status='Названия темы не должен перевисит 60 символов';
    }elseif($_SESSION['file_status']==2){
        $status='Неправильный номер лекции';
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Лекции</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="./teacher.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="./teacher.php">Главная</a>
    <a class="btn" style="color: white; position:absolute; margin-left:75%; bottom:90%;" href="oait_teacher.php">Вернуться назад</a>
    </nav>
</div>
</div>
<div style="border: 3px solid Navy;margin:5%;">
    <div style="padding:3%;color: Navy;">
    <span style="font-size: 20px; ">Добавить файлы</span>
    <div style="border: 1px solid #dfe4e9;padding:1%;" class="container"><br>
        <form action="lecture_load.php" method="POST" enctype="multipart/form-data">
        <?php if($color==1){
        ?><div style="color: green;"><?php echo $status;$_SESSION['file_status']=3;?></div><?php
        }else{
            ?><div style="color: red;"><?php echo $status;$_SESSION['file_status']=3;?></div><?php
        }?>
            <input type="text" name="text" placeholder="Введите названия темы" size="23" required>
            <input style="margin-left:4%;" type="number" name="number" placeholder="Номер лекции"  min=1 required><br>
            <input type="file" name="file">
            <input type="submit"  value="⏳ Загрузить">
        </form>
    </div></div>
    <span style="font-size: 16px;margin-left:15%;color: Navy; ">Добавленные файлы</span><br>
    <?php 
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $result=$mysql->query("SELECT * 
    FROM material
    JOIN work on material.id_work=work.id_work
    LEFT JOIN lesson on material.id_lesson = lesson.id_lesson
    ORDER BY material.id_lesson");
    $materials= $result -> fetch_assoc();
    if(count($materials)>0){
    do
    {
        $path="../lecture/".$materials['link'];
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;color:white;">
        <a style="border:0px;" class="btn-outline-success btn" href="<?php echo $path?>"><?php echo $materials['name_lesson'].' '.$materials['work_name']?></a>
        <input data-id="delete" class="btn btn-outline-danger" type="submit" value="удалить"><br>
        </div><?php
    }
    while($materials= $result -> fetch_assoc());
    $mysql->close();
    }else{
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;"><span>пусто</span></div><?php
    }
    ?>
    <br><br></div>
<?php require '../blocks/footer.php' ?>
</body>
</html>