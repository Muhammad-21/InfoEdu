<?php
session_start();
require 'exit/exit.php';
$user_id=$_SESSION["id_user"];
$status=filter_var(trim($_GET['status']),FILTER_SANITIZE_STRING);
if($_SESSION['img_status']==1){
    $err="Тип файла несоответсвует";
    $e=1;//помощьник
}elseif($_SESSION['img_status']==-1){
    $err="Произошла неизвестная ошибка";
    $e=1;
}
$mysql=new mysqli('localhost','root','','InfoEdu');
$res=$mysql->query("SELECT * From user WHERE user.id_user=$user_id");
$mail=$res->fetch_assoc();

$group_number = $_SESSION['group_number'];
$results=$mysql->query("SELECT * From `course` JOIN `group` ON `group`.id_group=`course`.id_group WHERE `group_number`='$group_number'");
$courses=$results->fetch_assoc(); 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/courses.css">
    <title>Личный кабинет</title>
</head>
<body>
    <?php require 'blocks/header.php'?>
    <div data-id="root">
    <!-- Информация о студенте -->
    <div data-person="person">
    <form method="POST" action="../load_img.php" enctype="multipart/form-data" style="margin-left: 24%; margin-top:5%;">
            <label class="custom-file-upload">
                <input name="image" style="display:none;" type="file" onchange="form.submit()"/>
                <img src="<?php echo '../img/users/'.$mail['photo_link']?>" alt="person" title="выберите фотографию" width="120px" style="border-radius:100px; box-shadow:0 0 15px #666;">
            </label>
        </form>
        <?php if($mail['photo_link']!=='personw.jpg' && $mail['photo_link']!=='person.jpg'){?>
            <a class="btn-danger btn" style="margin-left:22%" href="../delete_img.php?link=<?php echo $mail['photo_link'];?>">удалить фотографию</a>
        <?php }elseif($e==1){
            ?><div style="margin-left:21%; color:red"><?php echo $err;?></div><?php
            $err='';
            $e='';
            $_SESSION['img_status']='end';
        }?>

        <div style="color: Navy; margin-left:38%; margin-top:-9%; position:absolute;">
            <div>Имя: <?php echo $_SESSION['user_name']?></div>
            <div>Фамилия: <?php echo $_SESSION['user_last_name']?></div>
            <div>Отчество: <?php echo $_SESSION['user_middle_name']?></div>
            <div>Номер группы: <?php echo $group_number?></div>
        </div>
    </div>

    <!-- Раздел мои курсы -->
    <div data-course="courses">
    <h4 style="margin-top:5%; color:Navy; margin-left:15%;">Доступные курсы</h4>
    <?do{
        $id_student = $_SESSION['id_student'];
        $id_course = $courses['id_course'];
        $result_user=$mysql->query("SELECT * From `study` WHERE `id_student`='$id_student' AND `id_course`='$id_course'");
        $is_join = $result_user->fetch_assoc();
        if(count($is_join) > 0 ){
        ?>
            <div class="course">
                <div>
                    <a href="oait.php" style="color:black;" ><?echo $courses['course_name']?></a>
                    <strong data-id="descrip" class="descrip">описание курса</strong>
                    <div data-id="descripBody" class="descrip__body"><? if($courses['description'] !== ""){echo $courses['description'];}else{echo "Описание ещё не добавлен";} ?></div>
                </div>            
            </div><br>
        <?}else{ ?>
        <div class="course">
                <div>
                    <div style="color:black;" ><?echo $courses['course_name']?></div>
                    <strong data-id="descrip" class="descrip">описание курса</strong>
                    <div data-id="descripBody" class="descrip__body"><? if($courses['description'] !== ""){echo $courses['description'];}else{echo "Описание ещё не добавлен";} ?></div>
                </div>
                <div>
                    <form method="POST" action="./scripts/joinToCourse.php">
                        <input type="hidden" name="id_student" value="<? echo $id_student;?>">
                        <input type="hidden" name="id_course" value="<? echo $id_course;?>">
                        <button class="btn btn-success">записаться</button>
                    </form>
                </div>
            </div><br>
    <? }
    }while($courses=$results->fetch_assoc())?>
    </div>
    <?php require 'scripts/rating.php'?>
    <!-- Раздел рейтинг -->
    <div data-rating="rating">
        <h3 style="margin-left: 15%; margin-top:5%;" ><span>Рейтинг по всем курсам</span></h3>
        <h5 style="margin-left: 15%;" >Ваш средний балл: <?php echo $my_assessment?></h5>
       <div style="border: 3px solid Navy; padding: 40px; margin-left:15%;margin-right:15%;">
            <div data-id="loader"><img src="./img/loading.gif" style="width:6%;"alt="loader">Загружаем рейтинг</div>
            <div data-block="block">
            <div style="background: Navy; color:white;">
        
            <div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm" style="font-size: 20px;">
                <div style="margin-left: 5%;">Имя</div>
                <div style="margin-left: 68%;">Средний балл</div>
            </div>
            </div>
            <?php
            do{
            ?>
                <div style="border: 0.5px solid Navy; "></div>
                <br>
                <p style="margin-left: 4%;font-size: 18px;"> <?php echo $assessments['name']," ",$assessments['last_name']," ",$assessments['middle_name'];
                if($assessments['id_user']==$_SESSION['id_user']){
                ?>
                <img src="img/you.svg" style="width: 18px;"><?php
                }
                ?>
                <div style="margin-left: 85%; margin-top:-6%;font-size: 18px;"><?php echo $assessments['assessmeent']?></div></p>
            <?php }
            while($assessments= $result -> fetch_assoc());
            ?>
        </div>
       </div>
    </div>
    </div>
    <?php require 'blocks/footer.php';
    $mysql->close();
    ?>
    <script src="./js/header.js"></script>
</body>
</html>