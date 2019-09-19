<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div id = "form">
    <div id ="filmname">
        Название фильма:<br>
        Жанр:<br>
        Картинка:<br>
        Описание:<br><br><br>
        Добавить расписание к фильму:<br>
        Введите дату: время день.месяц
    </div>
    <div id ="inputField">
        <form action = "" method = "post" name="adminForm">
        <input name="filmName" type = "text" value=""><br>
        <input name="genre" type = "text" value=""><br>
        <input name="image" type = "text" value=""><br>
        <input name="descr" type = "text" value=""><br>
        <input type = "submit" name = "submit">
        </form>
        <?php
        $host = 'localhost'; // адрес сервера
        $database = 'id9787837_abc'; // имя базы данных
        $user = 'id9787837_cinemajoy'; // имя пользователя
        $password = '12345678'; // пароль
        $link = mysqli_connect($host, $user, $password, $database);
        if (!$link) {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit;
        }
        mysqli_query($link,"SET NAMES 'utf8'");
        mysqli_query($link,"SET CHARACTER SET 'utf8'");
        if (isset($_POST['submit'])) {
            $sql = mysqli_query($link, "INSERT INTO abc VALUES ('".$_POST['filmName']."','".$_POST['genre']."','Картинки/".$_POST['image'].".jpg','".$_POST['descr']."')");
        }
        ?>
        <br>
        <form action = "" method = "post" name="addForm">
        <select name = "selectedFilm">
            <?php
            $host = 'localhost'; // адрес сервера
            $database = 'id9787837_abc'; // имя базы данных
            $user = 'id9787837_cinemajoy'; // имя пользователя
            $password = '12345678'; // пароль
            $link = mysqli_connect($host, $user, $password, $database);
            mysqli_query($link,"SET NAMES 'utf8'");
            mysqli_query($link,"SET CHARACTER SET 'utf8'");
            if (!$link) {
                echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                exit;
            }
            $sql = mysqli_query($link,"set names 'utf8'");
            $sql = mysqli_query($link, "SELECT a FROM abc");
            while ($result = mysqli_fetch_array($sql)) {
                echo ("<option value ='".$result['a']."'>".$result['a']."</option>");
            }
            ?>
        </select>
        <br><br>
        <input name="date" type = "text" value=""><br>
        <input type = "submit" name = "addDate">
        </form>
        <?php
        $host = 'localhost'; // адрес сервера
        $database = 'id9787837_abc'; // имя базы данных
        $user = 'id9787837_cinemajoy'; // имя пользователя
        $password = '12345678'; // пароль
        $link = mysqli_connect($host, $user, $password, $database);
        mysqli_query($link, "SET NAMES 'utf8'");
        mysqli_query($link, "SET CHARACTER SET 'utf8'");
        if (!$link) {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit;
        }
        if (isset($_POST['addDate'])) {
            for($i = 1; $i <11; $i++){
                for($j =1; $j < 11; $j++){
                    $sql = mysqli_query($link, "insert into schedue values ('".$_POST['selectedFilm']."','".$_POST['date']."', ".$i.",".$j.", 'true')");
                }
            }
        }
        ?>
    </div>
    <div id = "deleteField">
        <form action = "" method = "post" name = "dAdminForm">
            Напишите имя фильма, который хотите удалить: <input name = "deleteFilmName"  type = "text" value=""><br>
            <input name = "delete" type = submit value = "Удалить"><br><br><br>
            Выберите сеанс, который хотите удалить<select name = "selectedSession">
                <?php
                $host = 'localhost'; // адрес сервера
                $database = 'id9787837_abc'; // имя базы данных
                $user = 'id9787837_cinemajoy'; // имя пользователя
                $password = '12345678'; // пароль
                $link = mysqli_connect($host, $user, $password, $database);
                mysqli_query($link,"SET NAMES 'utf8'");
                mysqli_query($link,"SET CHARACTER SET 'utf8'");
                if (!$link) {
                    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                    exit;
                }
                $sql = mysqli_query($link,"set names 'utf8'");
                $sql = mysqli_query($link, "SELECT DISTINCT name, date FROM schedue");
                while ($result = mysqli_fetch_array($sql)) {
                    echo ("<option value = \"name = '".$result['name']."' and '".$result['date']."'\">".$result['name']." в ".$result['date'] ."</option>");
                }
                ?>
            </select><br>
            <input name = "deleteS" type = submit value = "Удалить">
        </form>
        <?php
        $host = 'localhost'; // адрес сервера
        $database = 'id9787837_abc'; // имя базы данных
        $user = 'id9787837_cinemajoy'; // имя пользователя
        $password = '12345678'; // пароль
        $link = mysqli_connect($host, $user, $password, $database);
        mysqli_query($link,"SET NAMES 'utf8'");
        mysqli_query($link,"SET CHARACTER SET 'utf8'");
        if (!$link) {
            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
            exit;
        }
        $sql = mysqli_query($link,"set names 'utf8'");
        if (isset($_POST['delete'])) {
            $sql = mysqli_query($link, "delete from abc where a = '".$_POST['deleteFilmName']."'");
        }
        if(isset($_POST['deleteS']))
        {
            $sql = mysqli_query($link, "delete from schedue where ".$_POST['selectedSession']);

        }
        ?>
    </div>
</div>