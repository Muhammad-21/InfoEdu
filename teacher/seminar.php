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
        $status='Неправильный номер семинара';
    }elseif($_SESSION['file_status']==-11){
        $status='Тип файла выбран неправильно!';
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
    <a class="btn" data-id="dz" style="color: white;" href="home_work.php">ДЗ студентов</a>
    <a class="btn" style="color: white; position:absolute; margin-left:60%; bottom:90%;" href="oait_teacher.php">Вернуться назад</a>
    </nav>
</div>
</div>
<div style="border: 3px solid Navy;margin:5%;">
    <div style="padding:3%;color: Navy;">
    <span style="font-size: 20px; ">Добавить файлы</span>
    <div style="border: 1px solid #dfe4e9;padding:1%;" class="container"><br>
        <form action="seminar_load.php" method="POST" enctype="multipart/form-data">
        <?php if($color==1){
        ?><div style="color: green;"><?php echo $status;$_SESSION['file_status']=3;?></div><?php
        }else{
            ?><div style="color: red;"><?php echo $status;$_SESSION['file_status']=3;?></div><?php
        }?>
            <input type="text" name="text" placeholder="Введите названия темы" size="23" required>
            <input style="margin-left:1%;" type="number" name="number" placeholder="Номер семинара"  min=1 required>
            <select required name="material_type" size="1">
            <option selected disabled>Выберите тип файла</option>
            <option>Задания для студентов</option>
            <option>Материал для подготовки</option>
            </select><br>
            <input type="file" name="file">
            <input style="margin-left:18%;" type="submit"  value="⏳ Загрузить">
        </form>
    </div></div>
    <span style="font-size: 16px;margin-left:15%;color: Navy; ">Добавленные метериалы для подготовки</span><br>
    <?php 
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
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
        ?><div data-id="del" style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;color:white;">
        <a data-id = "link" style="border:0px;" class="btn-outline-success btn" href="<?php echo $path?>"><?php echo $materials['name_lesson'].' '.$materials['work_name']?></a>
        <input data-id="delete" class="btn btn-outline-danger" type="submit" value="удалить"><br>
        </div><?php
    }
    while($materials= $result -> fetch_assoc());
    }else{
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;"><span>пусто</span></div><?php
    }
    //дз
    ?><br><span style="font-size: 16px;margin-left:15%;color: Navy; ">Добавленные задания</span><br><?php
    $result1=$mysql->query("SELECT * 
    FROM material
    JOIN work on material.id_work=work.id_work
    LEFT JOIN lesson on material.id_lesson = lesson.id_lesson
    WHERE work.work_type='дз_семинар'
    ORDER BY material.id_lesson");
    $dz= $result1 -> fetch_assoc();
    if(count($dz)>0){
    do
    {
        $path="../seminar/".$dz['link'];
        ?><div data-id="del" style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;color:white;">
        <a data-id = "link" style="border:0px;" class="btn-outline-success btn" href="<?php echo $path?>"><?php echo $dz['name_lesson'].' '.$dz['work_name']?></a>
        <input data-id="delete" class="btn btn-outline-danger" type="submit" value="удалить"><br>
        </div><?php
    }
    while($dz= $result1 -> fetch_assoc());
    $mysql->close();
    }else{
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;"><span>пусто</span></div><?php
    }
    ?>
    <br><br></div>
<?php require '../blocks/footer.php' ?>
<script>
            const deleteEl = document.querySelectorAll('[data-id="delete"]');
            const delEl = document.querySelectorAll('[data-id="del"]');
            const linkEl = document.querySelectorAll('[data-id="link"]');
            for(let i=0;i<=deleteEl.length-1;i++){
                deleteEl[i].onclick =()=> {
                   delEl[i].remove();
                   location.href = "delete_seminar.php?link=" + linkEl[i].href;
                }
            }
</script>
</body>
</html>