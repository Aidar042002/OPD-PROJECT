<?php
session_start();
if (isset($_POST['mail'])) { $mail = $_POST['mail'];}
if (isset($_POST['password'])) { $password = $_POST['password'];}

$mail = stripslashes($mail);
$mail = htmlspecialchars($mail);
$password = stripslashes($password);
$password = htmlspecialchars($password);
//удаляем лишние пробелы
$mail = trim($mail);
$password = trim($password);

include("bd.php");

$result = mysqli_query($db, "SELECT * FROM users WHERE mail='$mail'");
$myrow =  mysqli_fetch_array($result);


if (empty($myrow['password']))
    {
    //если пользователя с введенным логином не существует
    exit ("Извините, введённый вами login или пароль неверный.");
    }
    else {
    //если существует, то сверяем пароли
    if ($myrow['password']==$password) {
    //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!
    $_SESSION['mail']=$myrow['mail'];
    $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
    header("Location:профессии.html");
    }
 else {
    //если пароли не сошлись

    exit ("Извините, введённый вами login или пароль неверный. Вернитесь назад");
      }
    }
 ?>
