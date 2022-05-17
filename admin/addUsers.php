<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/addStudents.css">
  <title>Одобрение заявок</title>
</head>
<body>
<div data-id="us">
  <h4 style="margin-top:5%;" class="container">Заявки студентов на регистрацию | <a href="admin.php"> вернуться назад</a></h4>
        <?php 
        $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
        $results=$mysql->query("SELECT * From `user` WHERE `status`='0' ORDER BY `last_name`");
        $us=$results->fetch_assoc();
        if(count($us) == 0){
        ?>
          <div style="margin-left:40%">список пуст</div>
        <?
        }else{
            do{
              $id = $us['id_user'];
              
              $co = $mysql->query("SELECT * FROM `teacher` WHERE `id_user` = '$id'");
              $count_teacher = $co -> fetch_assoc();

              
              if($count_teacher){
                $type = '<strong>Преподаватель</strong>';
                $post = '<br><strong>Должности: </strong>'.$count_teacher['post'];
                $color = 'badge-dark badge';
              }else{
                $co_stud = $mysql->query("SELECT `group`.`group_number` 
                                            FROM `group` 
                                            JOIN `student` on `group`.`id_group`=`student`.`id_group`
                                            WHERE `student`.`id_user`='$id'");
                $count_student = $co_stud -> fetch_assoc();
                if($count_student){
                  $type = '<strong>Студент группы: </strong>'.$count_student['group_number'];
                  $color = 'badge-light badge';
                }                
              }
        ?>        <div class="container list" style="border: 2px solid black;margin-top:2%;padding:2%"> 
                    <div><?php echo $us['last_name'].' '.$us['name'].' '.$us['middle_name']?></div>
                    <div class="<?php echo $color;?>" style="font-size:10px;"><?php echo $type;?></div>
                  </div>
                  <div class="modal">
                    <div class="modal-content">
                      <div align="end"><button class="modal__exit">x</button></div>
                      <div style="display: flex;">
                        <img class="img" src="<?php echo '../img/users/'.$us['photo_link']?>" alt="фотография профиля">
                        <div class="us__inf">
                            <div><strong>id: </strong><?php echo $us['id_user']?></div>
                            <div><strong>Фамилия: </strong><?php echo $us['last_name']?></div>
                            <div><strong>Имя: </strong><?php echo $us['name']?></div>
                            <div><strong>Отчество: </strong><?php echo $us['middle_name']?></div>
                            <div><?php echo $type; if($post !== ''){ echo $post;$post='';}?></div>
                        </div>
                      </div>
                      <form action="scripts/addUsers.php?status=add&id=<?php echo $us['id_user']?>" method="POST">
                        <button style="margin-top:4%; width: 450px;" class="btn btn-success">принять</button>
                      </form>
                      <form action="scripts/addUsers.php?status=reject&id=<?php echo $us['id_user']?>" method="POST">
                        <button style="margin-top:2%; width: 450px;" class="btn btn-danger">отклонить</button>
                      </form>
                    </div>
                  </div>
              <?php
              }
            while ($us=$results->fetch_assoc());
        }
            ?>
    </div>
<script src="../js/addUsers/add.js"></script>
</body>
</html>