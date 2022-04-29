<?php
    session_start();
    $user_id=filter_var(trim($_GET['user_id']),FILTER_SANITIZE_STRING);
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $res=$mysql->query("SELECT * FROM user JOIN student on user.id_user=student.id_user WHERE user.id_user=$user_id");
    $list=$res->fetch_assoc();
    if($list==''){
        $res=$mysql->query("SELECT * FROM user WHERE user.id_user=$user_id");
        $list=$res->fetch_assoc();
        $teach='ok';//преподаватель
    }
    if($_SESSION['id_student']){
        $path='../student.php';
    }else{
        $path='../teacher/teacher.php';
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/accounts.css">
  <title><?php echo $list['last_name'].' '.$list['name'].' '.$list['middle_name']?></title>
</head>
<body>
    
<div class="container">
    <div class="main-body">
    
          <!-- Навигация -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo $path;?>">Главная</a></li>
              <li class="breadcrumb-item"><a href="../users.php">Пользователи</a></li>
              <li class="breadcrumb-item active" aria-current="page">Личный кабинет</li>
            </ol>
          </nav>
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="<?php echo '../img/users/'.$list['photo_link']?>" alt="person" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $list['name'],' ', $list['last_name']?></h4>
                      <?php if($teach=='ok'){
                            ?>
                                <p class="text-muted font-size-sm"><?php echo 'Преподаватель'?></p>
                        <?php }else{ ?>
                            <p class="text-muted font-size-sm"><?php echo 'Студент группы:'," Б18-504"?></p>
                      <?php } ?>
                      <a href="../mail/mail.php?user_id=<?php echo $list['id_user'];?>&name=<?php echo $list['name'].'&photo='.$list['photo_link'];?>" class="btn btn-primary">Написать сообщение</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                <?php if($teach=='ok'){?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe mr-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Расписание</h6>
                    <span class="text-secondary"><a href="https://home.mephi.ru/tutors/21410" target="__blank">ссылка</a></span>
                  </li>    
                <?}else{?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github mr-2 icon-inline"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>Github</h6>
                    <span class="text-secondary">example</span>
                  </li>
                <?}?>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                    <span class="text-secondary">example</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                    <span class="text-secondary">example</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">ФИО</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $list['last_name'],' ', $list['name'],' ', $list['middle_name']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php if($list['email']!=''){
                        echo $list['email'];
                    }else{
                        echo "Не указан";
                    }?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Телефон</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      +71234567890
                    </div>
                  </div>
                  <hr>
                  <?php if($teach=='ok'){?>
                    <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Курсы</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <ul>
                            <li>Основы автоматизированных информационных технологий</li>
                            <li>Базы данных</li>
                        </ul>
                    </div>
                  </div>
                    <?}?>
                </div>
              </div>
            </div>
          </div>

        </div>
    </div>
<?$mysql->close()?>

</body>
</html>