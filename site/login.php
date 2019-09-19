<?php
# Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
        $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

# Если есть куки с ошибкой то выводим их в переменную и удаляем куки
if (isset($_COOKIE['errors'])){
    $errors = $_COOKIE['errors'];
    setcookie('errors', '', time() - 60*24*30*12, '/');
}

$host = 'localhost'; // адрес сервера
$database = 'id9787837_abc'; // имя базы данных
$user = 'id9787837_cinemajoy'; // имя пользователя
$password = '12345678'; // пароль
$link = mysqli_connect($host, $user, $password, $database) or die ("MySQL Error: " . mysqli_error());
mysqli_query($link,"set names utf8") or die ("<br>Invalid query: " . mysqli_error());
mysqli_select_db($link, $database) or die ("<br>Invalid query: " . mysqli_error());


if(isset($_POST['toLog']))
{

    # Вытаскиваем из БД запись, у которой логин равняеться введенному
    $data = mysqli_fetch_assoc(mysqli_query($link,"SELECT users_id, users_password FROM users WHERE users_login='".mysqli_real_escape_string($link,$_POST['userLogin'])."' LIMIT 1"));
    # Соавниваем пароли
    if(strcmp($data['users_password'],md5(md5($_POST['pass']))) == 0)
    {
        # Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        # Записываем в БД новый хеш авторизации и IP
        mysqli_query($link,"UPDATE users SET users_hash='".$hash."' WHERE users_id='".$data['users_id']."'") or die("MySQL Error: " . mysqli_error());

        # Ставим куки
        setcookie("id", $data['users_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
        if (strcmp($_POST['userLogin'],'admin') == 0){
            echo "<script>window.location.href='index.php?admin=1'</script>";
        }
        else {
            echo "<script>window.location.href='index.php?logged=1'</script>";
        }

    }
    else
    {
        print "Вы ввели неправильный логин/пароль<br>";
    }
}
?>
    <form method="POST">
        Логин <input name="userLogin" type="text"><br>
        Пароль <input name="pass" type="password"><br>
        <input name="toLog" type="submit" value="Войти">
    </form>