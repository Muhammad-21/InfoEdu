<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/attendance.css">
    <title>Индивидуальная посещаемость</title>
</head>
<body>
<div class="container">
    <div class="main-body">
    
          <!-- Навигация -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-light" href="../student.php">Главная</a></li>
              <li class="breadcrumb-item" aria-current="page">Индивидуальная посещаемость</li>
            </ol>
          </nav><br>
          <h2>Индивидуальная посещаемость</h2>

        <div style="display:flex;padding:10px;justify-content:space-between">
          <div>Пропущенных занятий в текущем семестре: <div style="color:red; display:inline">5</div></div>
          <div style="cursor:pointer;" class="inf">Информация о группе <i class="fa fa-info-circle fa-lg" style="color:#2aa493"></i></div>
        </div>
    
        <div class="block">
          <div>
            <div>Уровень обучения</div>
            <strong>ВО, Бакалавриат</strong>
          </div>
          <div>
            <div>Направление</div>
            <strong>Программная инженерия</strong>
          </div>
          <div>
            <div>Номер группы</div>
            <strong>Б18-504</strong>
          </div>
        </div>
</div>
</div>
<script>
  const grEl = document.querySelector('.inf');
  const block = document.querySelector('.block');
  grEl.onclick = () => {
    if(block.style.display !== "flex"){
      block.style.display="flex"
    }else{
      block.style.display="none"
    }
  }
</script>
</body>
</html>