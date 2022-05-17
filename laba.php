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
    <link rel="stylesheet" href="./css/students.css">
    <title>Лабораторные занятия</title>
</head>
<body>
<div style="background-color: #e9ecef;position:fixed; top:0; width: 100%; z-index:1">
<div class="d-flex align-items-center flex-md-row p-3 px-md-6  shadow-sm">
<a class="p-2 text-dark" href="./student.php" style="text-decoration: none;"><span style="color: navy; font-size: 25px; font-style:italic">InfoEdu</span></a>
<nav class="my-md-1" style="width: 100%;">
    <a class="btn button__hover" href="./student.php">Главная</a>
    <a class="btn button__hover" style="float:right" href="oait.php">Вернуться назад</a>
    </nav>
</div>
</div>
<div style="border: 3px solid Navy;margin:5%;margin-top:10%;"><br>
<span style="font-size: 16px;margin-left:15%;color: Navy; ">Добавленные метериалы для подготовки</span><br>
    <?php 
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $result=$mysql->query("SELECT * 
    FROM material
    JOIN work on material.id_work=work.id_work
    LEFT JOIN lesson on material.id_lesson = lesson.id_lesson
    WHERE work.work_type='лаба'
    ORDER BY material.id_lesson");
    $materials= $result -> fetch_assoc();
    if(count($materials)>0){
    do
    {
        $path="../laba/".$materials['link'];
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
    WHERE work.work_type='дз_лаба'
    ORDER BY material.id_lesson");
    $dz= $result1 -> fetch_assoc();
    if(count($dz)>0){
    do
    {
        $work_id=$dz['id_work'];
        $srav=$mysql->query("SELECT * 
        FROM work 
        WHERE work.work_type='дз' AND work.id_student='$id_st' AND work.work_name='$work_id'");
        $load_dz= $srav -> fetch_assoc();
        $path="../laba/".$dz['link'];
        ?>
            <div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%; color:navy;">
        <?php if(!count($load_dz)>0){ ?>
        <form action="load_dz.php?name_lesson=<?php echo substr($dz['name_lesson'],28)?>&work_name=<?php echo $dz['id_work']?>&laba=1" method="POST" enctype="multipart/form-data">
        <a style="border:0px;" class="btn-outline-primary btn" href="<?php echo $path?>"><?php echo $dz['name_lesson'].' '.$dz['work_name']?></a><br>
            <input type="file" name="file"/>
            <input type="submit" class="btn btn-outline-success"  value="загрузить решения"/><br>
        </form>
        <?php }elseif($load_dz['assessmeent']==-1){
            $mater=$mysql->query("SELECT * 
            FROM material
            JOIN WORK ON  material.id_work=work.id_work 
            WHERE work.work_name='$work_id'");
            $m= $mater -> fetch_assoc();
            $dz_path="dz_laba/".$m['link'];
            ?>
            <a style="border:0px;" class="btn-outline-primary btn" href="<?php echo $path?>"><?php echo "Задание:".$dz['name_lesson'].' '.$dz['work_name']?></a>
            <a  style="border:0px;" class="btn-outline-primary btn" href="<?php echo $dz_path?>"><?php echo "Решение:".' '.$dz['work_name']?></a>
            <span class="bg-warning badge" style="color: white;"  >отправлен на проверку</span><?php 
            }elseif($load_dz['assessmeent']==-2){
                $mater=$mysql->query("SELECT * 
                FROM material
                JOIN WORK ON  material.id_work=work.id_work 
                WHERE work.work_name='$work_id'");
                $m= $mater -> fetch_assoc();
                $dz_path="../dz_laba/".$m['link'];
                ?>
            <form action="load_dz.php?name_lesson=<?php echo substr($dz['name_lesson'],28)?>&work_name=<?php echo $dz['id_work']?>&link=<?php echo $m['link']?>&laba=1" method="POST" enctype="multipart/form-data">
            <a style="border:0px;" class="btn-outline-primary btn" href="<?php echo $path?>"><?php echo "Задание:".$dz['name_lesson'].' '.$dz['work_name']?></a>
                <a data-id = "link" style="border:0px;" class="btn-outline-primary btn" href="<?php echo $dz_path?>"><?php echo "Решение:".' '.$dz['work_name']?></a>
                <span class="bg-danger badge" style="color: white;"  >отправлен на доработку</span><br>
                <span class="bg-danger badge" style="color: white;">замечания:</span>
                <span class="badge" ><?php echo $m['comment']?></span><br>
                <input type="file" name="file"/>
                <input type="submit" class="btn btn-outline-success"  value="загрузить решения"/><br>
            </form>
            <?php
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
<!-- <script>
            const deleteEl = document.querySelectorAll('[data-id="delete"]');
            const linkEl = document.querySelectorAll('[data-id="link"]');
            for(let i=0;i<=deleteEl.length-1;i++){
                deleteEl[i].onclick =()=> {
                  location.href = "load_dz.php?number="+linkEl[i].textContent;
                }
            }
</script> -->
</body>
</html>