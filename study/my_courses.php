<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/courses.css">
    <link rel="stylesheet" href="../css/students.css">
    <title>Document</title>
</head>
<body>
<div data-course="courses">
    <h4 style="margin-top:5%; color:Navy; margin-left:15%;">Доступные курсы</h4>
    <?
        $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
        $group_number = $_SESSION['group_number'];
        $results=$mysql->query("SELECT * From `course` JOIN `group` ON `group`.id_group=`course`.id_group WHERE `group_number`='$group_number'");
        $courses=$results->fetch_assoc();
        do{ 
        $id_student = $_SESSION['id_student'];
        $id_course = $courses['id_course'];
        $result_user=$mysql->query("SELECT * From `study` WHERE `id_student`='$id_student' AND `id_course`='$id_course'");
        $is_join = $result_user->fetch_assoc();
        if(count($is_join) > 0 ){
        ?>
            <div class="course">
                <div>
                    <a href="../oait.php" style="color:black;" ><?echo $courses['course_name']?></a>
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
    <script src="../js/joining_to_courses.js"></script>
</body>
</html>