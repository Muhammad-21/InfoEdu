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
$mysql=new mysqli('127.0.0.1','root','','InfoEdu');
$res=$mysql->query("SELECT * From user WHERE user.id_user=$user_id");
$mail=$res->fetch_assoc();
$_SESSION['user_photo'] = $mail['photo_link'];
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./css/courses.css"> -->
    <link rel="stylesheet" href="./css/students.css">
    <title>Личный кабинет</title>
</head>
<body style="background:#e2e8f0;">
    <?php require 'blocks/header.php'?>
    <div style="margin-top: 120px;" data-id="root">
    <!-- Информация о студенте -->
    <div data-person="person">
    <div class="container bootstrap snippets bootdeys">
    <div class="row" id="user-profile">
        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="main-box clearfix">
                <h2><?php echo $_SESSION['user_name']?></h2>
                <div class="profile-status">
                    <i class="fa fa-check-circle"></i> Online
                </div>
                <form method="POST" action="../load_img.php" enctype="multipart/form-data">
                    <label style="cursor:pointer" title="выберите фотографию" class="img__link custom-file-upload">
                        <!-- <a href="#" class="img__link"> -->
                        <input name="image" style="display:none;" type="file" onchange="form.submit()"/>
                        <img src="<?php echo '../img/users/'.$mail['photo_link']?>" alt="person" class="profile-img img-responsive">
                        <!-- </a> -->
                    </label>
                </form>
                <?php if($mail['photo_link']!=='personw.jpg' && $mail['photo_link']!=='person.jpg'){?>
                        <a style="margin:10%;color:red" href="../delete_img.php?link=<?php echo $mail['photo_link'];?>">удалить фотографию</a><br>
                    <?php }elseif($e==1){
                        ?><div style="margin-left:21%; color:red"><?php echo $err;?></div><?php
                        $err='';
                        $e='';
                        $_SESSION['img_status']='end';
                    }?>
                <div class="profile-label">
                    <span class="btn" style="background-color: grey;color:white">Студент группы <?php echo $group_number?></span>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-18 col-sm-8">
            <div class="main-box clearfix">
                <div class="profile-header">
                    <h3><span>Профиль пользователя</span></h3>
                    <a href="#" class="btn btn-primary edit-profile">
                        <i class="fa fa-pencil-square fa-lg"></i> редактировать
                    </a>
                </div>

                <div class="row profile-user-info">
                    <div class="col-sm-8">
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Имя
                            </div>
                            <div class="profile-user-details-value">
                                <?php echo $_SESSION['user_last_name']?>
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Фамилия
                            </div>
                            <div class="profile-user-details-value">
                                <?php echo $_SESSION['user_name']?>
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Отчество
                            </div>
                            <div class="profile-user-details-value">
                                <?php echo $_SESSION['user_middle_name']?>
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Email
                            </div>
                            <div class="profile-user-details-value">
                                muhammadmahmudov21@yandex.ru
                            </div>
                        </div>
                        <div class="profile-user-details clearfix">
                            <div class="profile-user-details-label">
                                Телефон
                            </div>
                            <div class="profile-user-details-value">
                                +71234567890
                            </div>
                        </div>
                    </div><br>
                    <div class="col-sm-4 profile-social">
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-github-square"></i><a href="#">Muhammad-21</a></li>
                            <li><i class="fa-li fa fa-vk"></i><a href="#">Muhammad Mahmudov</a></li>
                            <li><i class="fa-li fa fa-instagram"></i><a href="#">21mukhammad</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="./js/headerss.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>