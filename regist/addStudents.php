<?
    header('Content-Type: text/html; charset= utf-8');
    $name=filter_var(trim($_POST['StudentName']),FILTER_SANITIZE_STRING);
    $lastName=filter_var(trim($_POST['StudentLastName']),FILTER_SANITIZE_STRING);
    $middleName=filter_var(trim($_POST['StudentMiddleName']),FILTER_SANITIZE_STRING);
    $numberCard=filter_var(trim($_POST['numberCard']),FILTER_SANITIZE_STRING);
    $groupNumber=filter_var(trim($_POST['groupNumber']),FILTER_SANITIZE_STRING);
    $login=filter_var(trim($_POST['StudentLogin']),FILTER_SANITIZE_STRING);
    $password=filter_var(trim($_POST['StudentPassword']),FILTER_SANITIZE_STRING);
    $StudentSex=filter_var(trim($_POST['StudentSex']),FILTER_SANITIZE_STRING);
    if($StudentSex == 'мужской'){
        $sex = 1;
    }
    if($StudentSex == 'женский'){
        $sex = 0;
    }

    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');

    ///получение id_group
    $sql=$mysql->query("SELECT * FROM `group` WHERE `group_number`='$groupNumber'");
    $res= $sql -> fetch_assoc();
    $id_group=$res["id_group"];


    ///добавление студенда
    $mysql->query("INSERT INTO `user`(`name`, `last_name`,`middle_name`,`login`,`password`,`sex`) VALUES('$name','$lastName','$middleName','$login','$password','$sex')");
    $mysql->query("INSERT INTO `student`(`card_number`,`id_group`,`id_user`) VALUES('$numberCard','$id_group',LAST_INSERT_ID())");

    $mysql->close();
    header('Location: regist.php?status=success');
?>