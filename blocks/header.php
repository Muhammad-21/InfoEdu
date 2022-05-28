<div style="background-color: #e9ecef;position:fixed; top:0; width: 100%; z-index:1">
<div class="d-flex align-items-center flex-md-row p-3 px-md-6  shadow-sm">
    <a class="p-2 text-dark" href="./student.php" style="text-decoration: none;"><span style="color: navy; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-md-1" style="width: 100%;">
        <a class="btn button__hover" href="./student.php">Главная</a>
        <a class="btn button__hover"  href="../users.php">Пользователи</a>
        <div style="cursor:pointer" class="btn button__hover" data-id="rating" class="btn button__hover"  >Рейтинг</div>
        <div style="display:inline" class="dropdown">
            <button data-id="course" class="button__hover btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown">
                Обучение <i class="fa fa-bell-o" style="color:red;"></i>
            </button>
            <ul class="button__hover dropdown-menu" aria-labelledby="dropdownMenuButton2">
                <li><a class="dropdown-item" href="#">Учебный план</a></li>
                <li><a class="dropdown-item" href="../study/attendance.php">Индивидуальная посещаемость</a></li>
                <li><a class="dropdown-item" href="../study/my_courses.php">Мои курсы</a></li>
                <li><a class="dropdown-item" href="../study/survey.php">Анкетирование <i class="fa fa-bell-o" style="color:red;"></i></a></li>
            </ul>
        </div>
        <a class="btn button__hover"  href="../mail/mail.php">Сообщения</a>
        <a class="btn button__hover" style="float:right" href="../exit.php">Выход</a>
    </nav>
</div>
</div>