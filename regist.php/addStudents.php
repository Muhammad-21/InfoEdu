<?
    $name=filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
    $lastName=filter_var(trim($_POST['lastName']),FILTER_SANITIZE_STRING);
    $middleName=filter_var(trim($_POST['middleName']),FILTER_SANITIZE_STRING);
    $numberCard=filter_var(trim($_POST['numberCard']),FILTER_SANITIZE_STRING);
    $groupNumber=filter_var(trim($_POST['groupNumber']),FILTER_SANITIZE_STRING);
    $login=filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
    $password=filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

?>