<?php
session_start();
require 'exit/exit.php';
$id_st=$_SESSION['id_student'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Семинарские занятия</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="./student.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="./student.php">Главная</a>
    <a class="btn" style="color: white; position:absolute; margin-left:75%; bottom:90%;" href="oait.php">Вернуться назад</a>
    </nav>
</div>
</div>
<div style="border: 3px solid Navy;margin:5%;"><br>
<span style="font-size: 16px;margin-left:15%;color: Navy; ">Добавленные метериалы для подготовки</span><br>
    <?php 
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $result=$mysql->query("SELECT * 
    FROM material
    JOIN work on material.id_work=work.id_work
    LEFT JOIN lesson on material.id_lesson = lesson.id_lesson
    WHERE work.work_type='семинар'
    ORDER BY material.id_lesson");
    $materials= $result -> fetch_assoc();
    if(count($materials)>0){
    do
    {
        $path="../seminar/".$materials['link'];
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;color:white;">
        <a data-id = "link" style="border:0px;" class="btn-outline-success btn" href="<?php echo $path?>"><?php echo $materials['name_lesson'].' '.$materials['work_name']?></a><br>
        </div><?php
    }
    while($materials= $result -> fetch_assoc());
    }else{
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;"><span>пусто</span></div><?php
    }
    //дз
    ?><br><span style="font-size: 16px;margin-left:15%;color: Navy; ">Домашние задания</span><br><?php
    $result1=$mysql->query("SELECT * 
    FROM material
    JOIN work on material.id_work=work.id_work
    LEFT JOIN lesson on material.id_lesson = lesson.id_lesson
    WHERE work.work_type='дз_семинар'");
    $dz= $result1 -> fetch_assoc();
    if(count($dz)>0){
    do
    {
        $work_id=$dz['id_work'];
        $srav=$mysql->query("SELECT * 
        FROM work 
        WHERE work.work_type='дз' AND work.id_student='$id_st' AND work.work_name='$work_id'");
        $load_dz= $srav -> fetch_assoc();
        $path="../seminar/".$dz['link'];
        ?>
            <div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%; color:navy;">
        <?php if(!count($load_dz)>0){ ?>
        <form action="load_dz.php?name_lesson=<?php echo substr($dz['name_lesson'],18)?>&work_name=<?php echo $dz['id_work']?>" method="POST" enctype="multipart/form-data">
        <a style="border:0px;" class="btn-outline-primary btn" href="<?php echo $path?>"><?php echo $dz['name_lesson'].' '.$dz['work_name']?></a><br>
            <input type="file" name="file"/>
            <input type="submit" class="btn btn-outline-success"  value="загрузить решения"/><br>
        </form>

        <!-- отправлен -->
        <?php }elseif($load_dz['assessmeent']==-1){
            $mater=$mysql->query("SELECT * 
            FROM material
            JOIN WORK ON  material.id_work=work.id_work 
            WHERE work.work_name='$work_id'");
            $m= $mater -> fetch_assoc();
            $dz_path="dz_seminar/".$m['link'];
            ?>
            <a style="border:0px;" class="btn-outline-primary btn" href="<?php echo $path?>"><?php echo "Задание:".$dz['name_lesson'].' '.$dz['work_name']?></a>
            <a  style="border:0px;" class="btn-outline-primary btn" href="<?php echo $dz_path?>"><?php echo "Решение:".' '.$dz['work_name']?></a>
            <span class="bg-warning badge" style="color: white;"  >отправлен на проверку</span><?php 
            //доработка
            }elseif($load_dz['assessmeent']==-2){
                $mater=$mysql->query("SELECT * 
                FROM material
                JOIN WORK ON  material.id_work=work.id_work 
                WHERE work.work_name='$work_id'");
                $m= $mater -> fetch_assoc();
                $dz_path="../dz_seminar/".$m['link'];
            ?>
            <form action="load_dz.php?name_lesson=<?php echo substr($dz['name_lesson'],18)?>&work_name=<?php echo $dz['id_work']?>&link=<?php echo $m['link']?>" method="POST" enctype="multipart/form-data">
            <a style="border:0px;" class="btn-outline-primary btn" href="<?php echo $path?>"><?php echo "Задание:".$dz['name_lesson'].' '.$dz['work_name']?></a>
                <a data-id = "link" style="border:0px;" class="btn-outline-primary btn" href="<?php echo $dz_path?>"><?php echo "Решение:".' '.$dz['work_name']?></a>
                <span class="bg-danger badge" style="color: white;"  >отправлен на доработку</span><br>
                <span class="bg-danger badge" style="color: white;">замечания:</span>
                <span class="badge" ><?php echo $m['comment']?></span><br>
                <input type="file" name="file"/>
                <input type="submit" class="btn btn-outline-success"  value="загрузить решения"/><br>
            </form>
            <?php
            //когда оценка есть 
            }elseif($load_dz['assessmeent']>=0){?>
            <a style="border:0px;" class="btn-outline-primary btn" href="<?php echo $path?>"><?php echo $dz['name_lesson'].' '.$dz['work_name']?></a>
            <span class="bg-success badge" style="color: white;"  >принято</span>
            <span style="color: green;"> оценка <?php echo $load_dz['assessmeent']." " ?></span>
            <?php }?>
            </div><?php
    }
    while($dz= $result1 -> fetch_assoc());
    $mysql->close();
    }else{
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;"><span>пусто</span></div><?php
    }
    ?>
    <br></div>
<?php require 'blocks/footer.php';?>
</body>
</html>