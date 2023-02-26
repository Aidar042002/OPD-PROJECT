<?php
echo "enter";
if(isset($_POST['name'])){ $name=$_POST['name'];}
if (isset($_POST['email'])) { $mail = $_POST['email'];} //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['text'])) { $password=$_POST['text'];}

$name=stripslashes($name);
$name=htmlspecialchars($name);
$mail = stripslashes($mail);
$mail = htmlspecialchars($mail);
$password = stripslashes($password);
$password = htmlspecialchars($password);
 //удаляем лишние пробелы
 $name=trim($name);
$mail = trim($mail);
$password = trim($password);
 // подключаемся к базе
include("bd.php");

$result = mysqli_query($db, "SELECT * FROM users WHERE mail='$mail'");
$myrow =  mysqli_fetch_array($result);

if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
 // если такого нет, то сохраняем данные
    $result2 = mysqli_query ( $db,"INSERT INTO users (mail, password, name) VALUES('$mail','$password', '$name')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    echo "Вы успешно зарегистрированы! Теперь вы можете зайти на сайт.<a href='вход.html'>Главная страница</a>";
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }

 ?>
