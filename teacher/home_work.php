<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>ДЗ студентов</title>
</head>
<body>
<div style="background-color: Navy ;">
<div class="d-flex align-items-center flex-column flex-md-row p-3 px-md-4  shadow-sm">
    <a class="p-2 text-dark" href="./student.php" style="text-decoration: none;"><span style="color: white; font-size: 25px; font-style:italic">InfoEdu</span></a>
    <nav class="my-2 my-md-0 me-md-3" >
    <a class="btn" style="color: white;" href="./teacher.php">Главная</a>
    <a class="btn" style="color: white; position:absolute; margin-left:70%; bottom:90%;" href="seminar.php">Вернуться назад</a>
    </nav>
</div>
</div>
<div style="border: 3px solid Navy;margin:5%;padding:2%;"><br>

    <span style="font-size: 16px;margin-left:15%;color: Navy; ">Домашние задания</span><br><?php
    $mysql=new mysqli('localhost','root','','InfoEdu');
    $result1=$mysql->query("SELECT * 
    FROM material
    JOIN work on material.id_work=work.id_work
    JOIN student on work.id_student=student.id_student
    JOIN user on student.id_user=user.id_user
    LEFT JOIN lesson on material.id_lesson = lesson.id_lesson
    WHERE work.work_type='дз' AND work.id_teacher=2
    ORDER BY material.id_lesson");
    $dz= $result1 -> fetch_assoc();?>
    <div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%; color:navy;"><?php
    if(count($dz['id_work'])>0){
    do
    {
        $dz_path="../dz_seminar/".$dz['link'];
        if($dz['assessmeent']==-1){
            ?>
            <br><div style="border: 1px solid #dfe4e9;padding:1%; color:navy;">
            <a href="../account/accounts.php?user_id=<?php echo $dz['id_user'];?>" ><div style="border:0px;" class="btn-outline-primary btn"><?php echo $dz['name'].' '.$dz['last_name'].' '.$dz['middle_name']?></div></a>
            <a  style="border:0px;" class="btn-outline-primary btn" href="<?php echo $dz_path?>"><?php echo "Решение:".' '.$dz['work_name']?></a><br>
            <textarea  data-id="message" class="form-control" placeholder="Введите ваши замечания"></textarea>
            <input data-id="delete" style="margin-left:72%;" name="<?php echo $dz['id_work']?>" class="btn btn-outline-danger" type="submit" value="отправить на доработку"><br><br>
            <input type="number" data-id="mark" class="form-control" placeholder="Оценка за работу" min=0>
            <input data-id="success" style="margin-left:88%;" name="<?php echo $dz['id_work']?>" class="btn btn-outline-success" type="submit" value="принят">
            </div><br>
        <?php }elseif($dz['assessmeent']==-2){?>
                <div style="border: 1px solid #dfe4e9;padding:1%; color:navy;">
                <div style="border:0px;" class="btn-outline-primary btn"><?php echo $dz['name'].' '.$dz['last_name'].' '.$dz['middle_name']?></div>
                <a  style="border:0px;" class="btn-outline-primary btn" href="<?php echo $dz_path?>"><?php echo "Решение:".' '.$dz['work_name']?></a>
                <span class="bg-warning badge" style="color: white;"  >отправлен на доработку</span><br>
                <span class="bg-danger badge" style="color: white;">замечания:</span>
                <span class="badge" ><?php echo $dz['comment']?></span><br>
                </div>
            <?php }elseif($dz['assessmeent']>=0){?>
                <div style="border: 1px solid #dfe4e9;padding:1%; color:navy;">
                <div style="border:0px;" class="btn-outline-primary btn"><?php echo $dz['name'].' '.$dz['last_name'].' '.$dz['middle_name']?></div>
                <a  style="border:0px;" class="btn-outline-primary btn" href="<?php echo $dz_path?>"><?php echo "Решение:".' '.$dz['work_name']?></a>
                <span class="bg-success badge" style="color: white;"  >принято</span>
                <span style="color: green;"> оценка <?php echo $dz['assessmeent']." " ?></span>
                </div>
            <?php }else{
                echo "пусто";
            }
    }
    while($dz= $result1 -> fetch_assoc());
    $mysql->close();
    ?> </div><?php
    }else{
        ?><div style="border: 1px solid #dfe4e9; margin-left:15%;margin-right:15%;padding:1%;"><span>пусто</span></div><?php
    }
    ?>
    <br></div>
    <?php require '../blocks/footer.php' ?>
    <script>
            const deleteEl = document.querySelectorAll('[data-id="delete"]');
            const delEl = document.querySelectorAll('[data-id="success"]');
            const markEl = document.querySelectorAll('[data-id="mark"]');
            const mesEl = document.querySelectorAll('[data-id="message"]');
            for(let i=0;i<=deleteEl.length-1;i++){
                deleteEl[i].onclick =()=> {
                   location.href = "delete_dz.php?id=" + deleteEl[i].name+"&message="+mesEl[i].value;
                }
                delEl[i].onclick = () =>{
                    location.href = "accept_dz.php?id="+ delEl[i].name+"&mark="+markEl[i].value;
                }
            }
    </script>
</body>
</html>