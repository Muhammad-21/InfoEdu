const backEl = document.querySelector('.back_main');
backEl.onclick = () => {
    if($_SESSION['id_student']){
        location.href="../student.php"
    }else{
        location.href="../teacher/teacher.php"
    }
}