<?php
# Подключаем конфиг
$host = 'localhost'; // адрес сервера
$database = 'id9787837_abc'; // имя базы данных
$user = 'id9787837_cinemajoy'; // имя пользователя
$password = ''; // пароль
$link = mysqli_connect($host, $user, $password, $database) or die ("MySQL Error: " . mysqli_error());
mysqli_query($link,"set names utf8") or die ("<br>Invalid query: " . mysqli_error());
mysqli_select_db($link, $database) or die ("<br>Invalid query: " . mysqli_error());
if(isset($_POST['submit']))
{

    $err = array();

    # проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    # проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link,"SELECT COUNT(users_id) FROM users WHERE users_login='".mysqli_real_escape_string($link,$_POST['login'])."'")or die ("<br>Invalid query: " . mysql_error());



    # Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login'];

        # Убераем лишние пробелы и делаем двойное шифрование
        $password = md5(md5(trim($_POST['password'])));

        mysqli_query($link,"INSERT INTO users VALUES (NULL,'$login','$password','') ");
        header("Location: index.php"); exit();
    }
}
?>

    <form method="POST" action="">
        Логин <input type="text" name="login" id="reg_inp" /><br />
        Пароль <input type="password" name="password" id="reg_inp" /><br />
        <input name="submit" type="submit" value="Зарегистрироваться">
    </form>
<?php
if (isset($err)) {
    print "<b>При регистрации произошли следующие ошибки:</b><br>";
    foreach($err AS $error)
    {
        print $error."<br>";
    }
}
?>