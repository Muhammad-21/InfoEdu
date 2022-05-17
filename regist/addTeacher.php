<?
    header('Content-Type: text/html; charset= utf-8');
    $name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $lastName=filter_var(trim($_POST['lastName']),FILTER_SANITIZE_STRING);
    $middleName=filter_var(trim($_POST['middleName']),FILTER_SANITIZE_STRING);
    $post=filter_var(trim($_POST['post']),FILTER_SANITIZE_STRING);
    $login=filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password=filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
    $sex=filter_var(trim($_POST['sex']),FILTER_SANITIZE_STRING);
    if($sex == 'мужской'){
        $sex = 1;
    }
    if($sex == 'женский'){
        $sex = 0;
    }

    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');

    ///добавление преподователя
    $mysql->query("INSERT INTO `user`(`name`, `last_name`,`middle_name`,`login`,`password`,`sex`) VALUES('$name','$lastName','$middleName','$login','$password','$sex')");
    $mysql->query("INSERT INTO `teacher`(`post`, `id_user`) VALUES('$post',LAST_INSERT_ID())");

    $mysql->close();
    header('Location: regist.php?status=success');
?>