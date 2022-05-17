<?  
    header('Content-Type: text/html; charset= utf-8');
    $groupNumber=filter_var(trim($_POST['groupNumber']),FILTER_SANITIZE_STRING);
    $groupName=filter_var(trim($_POST['groupName']),FILTER_SANITIZE_STRING);
    $mysql=new mysqli('127.0.0.1','root','','InfoEdu');
    $mysql->query("INSERT INTO `group` (`group_number`,`specialization`) VALUES('$groupNumber','$groupName')");
    $mysql->close();
    header('Location: ../admin.php');
?>