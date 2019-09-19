<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="look3.css"/>
    <title>CinemaJoy</title>
</head>
<body>
<div id="top">
    <div id="topDyn">
        <?php
        if(isset($_GET['logged'])){
            include ("topl.php");
        }
        else{
            include ("top.php");
        }
        ?>
    </div>
</div>
<div id="sidebar">
    <?php
    include ("sidebar.php");
    ?>
</div>
    <div id ="booking">
        <div id = "leftside">
            <?php
            $host = 'localhost'; // адрес сервера
            $database = 'id9787837_abc'; // имя базы данных
            $user = 'id9787837_cinemajoy'; // имя пользователя
            $password = ''; // пароль
            $link = mysqli_connect($host, $user, $password, $database);
            mysqli_query($link,"SET NAMES 'utf8'");
            mysqli_query($link,"SET CHARACTER SET 'utf8'");
            if (!$link) {
                echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                exit;
            }
            $sql = mysqli_query($link,"set names 'utf8'");
            ?>
            <table align="center" border="1" bordercolor = "darkgrey" width="500">
                <?php
                for ($i = 1; $i<11; $i++) {
                    echo("<tr> <th><font color='#a9a9a9'>Ряд $i</th>");
                    if (isset($_POST['selectedDate'])) {
                        $sql = mysqli_query($link, "SELECT acces,seatNum FROM schedue where name = '" . $_GET['filmname'] . "' and date ='" . $_POST['selectedDate'] . "' and line ='$i'");
                        while ($result = mysqli_fetch_array($sql)) {
                            if ($result['acces'] == 'true') {
                                echo("<th><font color='green' face='Comic Sans MS' size='6'> " . $result['seatNum'] . " </font></th>");
                            } else {
                                echo("<th><font color='red' face='Comic Sans MS' size='6'>" . $result['seatNum'] . "  </font></th>");
                            }
                        }
                    }
                    else {
                        for ($i = 1; $i<11; $i++)
                        {
                            echo("<tr>");
                            for ($j = 1; $j<11;$j++)
                            { echo("<th><font color='black' face='Comic Sans MS' size='6'> $j </font></th>");}
                            echo("</tr>");
                        }
                    }
                    echo("</tr>");
                }
                ?>
            </table>
        </div>
        <div id = "rightside">
            <?php
            echo("Фильм: ".$_GET['filmname'])
            ?>

            <form action="" method="post" name="booking">
                <br> Выберите время
                <select name = "selectedDate">
                    <?php
                    $host = 'localhost'; // адрес сервера
                    $database = 'id9787837_abc'; // имя базы данных
                    $user = 'id9787837_cinemajoy'; // имя пользователя
                    $password = ''; // пароль
                    $link = mysqli_connect($host, $user, $password, $database);
                    mysqli_query($link,"SET NAMES 'utf8'");
                    mysqli_query($link,"SET CHARACTER SET 'utf8'");
                    if (!$link) {
                        echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                        exit;
                    }
                    $sql = mysqli_query($link,"set names 'utf8'");
                    $sql = mysqli_query($link, "SELECT distinct date FROM schedue where name='".$_GET['filmname']."'");
                    while ($result = mysqli_fetch_array($sql)) {
                        echo ("<option value ='".$result['date']."'>".$result['date']."</option>");
                    }
                    ?>
                </select>
                <input type="submit" name = "choseDate" value = "Выбрать"><br>
                <br> Выберите ряд:
                <select name = "selectedLine">
                    <?php
                    if(isset($_POST['choseDate']) or isset($_POST['choseLine'])){
                        $host = 'localhost'; // адрес сервера
                        $database = 'id9787837_abc'; // имя базы данных
                        $user = 'id9787837_cinemajoy'; // имя пользователя
                        $password = ''; // пароль
                        $link = mysqli_connect($host, $user, $password, $database);
                        mysqli_query($link,"SET NAMES 'utf8'");
                        mysqli_query($link,"SET CHARACTER SET 'utf8'");
                        if (!$link) {
                            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                            exit;
                        }
                        $sql = mysqli_query($link,"set names 'utf8'");
                        $sql = mysqli_query($link, "SELECT distinct line FROM schedue where name ='".$_GET['filmname']."' and date='".$_POST['selectedDate']."'");
                        while ($result = mysqli_fetch_array($sql)) {
                            echo ("<option value ='".$result['line']."'>".$result['line']."</option>");
                        }
                    }?>
                </select>
                <input type="submit" name="choseLine" value="Выбрать"><br>
                Выберите место:
                <select name = "selectedSeatNum">
                    <?php
                    if(isset($_POST['choseLine'])){
                        $host = 'localhost'; // адрес сервера
                        $database = 'id9787837_abc'; // имя базы данных
                        $user = 'id9787837_cinemajoy'; // имя пользователя
                        $password = ''; // пароль
                        $link = mysqli_connect($host, $user, $password, $database);
                        mysqli_query($link,"SET NAMES 'utf8'");
                        mysqli_query($link,"SET CHARACTER SET 'utf8'");
                        if (!$link) {
                            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                            exit;
                        }
                        $sql = mysqli_query($link,"set names 'utf8'");
                        $sql = mysqli_query($link, "SELECT distinct seatNum FROM schedue where acces ='true' and name ='".$_GET['filmname']."' and date='".$_POST['selectedDate']."' and line ='".$_POST['selectedLine']."'");
                        while ($result = mysqli_fetch_array($sql)) {
                                echo ("<option value ='".$result['seatNum']."'>".$result['seatNum']."</option>");
                        }
                    }?>
                </select>
                <input type="button"  value = "Выбрать">
                <br>
                Введите номер карты:
                <input type="text" name ="cardNum"><br>
                Введите CVV/CVC:
                <input type="text" name ="CVVCVC"><br>
                <input type="submit" name="buy" value="Купить">
                <?php
                if(isset($_POST['buy']) and isset($_POST['selectedSeatNum']) and isset($_POST['selectedLine'])){
                    if (preg_match("/^[0-9]{3,4}$/",$_POST['CVVCVC']) and preg_match("/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/",$_POST['cardNum'])){
                        $host = 'localhost'; // адрес сервера
                        $database = 'id9787837_abc'; // имя базы данных
                        $user = 'id9787837_cinemajoy'; // имя пользователя
                        $password = ''; // пароль
                        $link = mysqli_connect($host, $user, $password, $database);
                        mysqli_query($link,"SET NAMES 'utf8'");
                        mysqli_query($link,"SET CHARACTER SET 'utf8'");
                        if (!$link) {
                            echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
                            exit;
                        }
                        $sql = mysqli_query($link,"set names 'utf8'");
                        $sql = mysqli_query($link,"Update schedue SET acces='false' where name='".$_GET['filmname']."' and line =".$_POST['selectedLine']." and seatNum=".$_POST['selectedSeatNum']);
                    }
                    else echo "Данные карты некорректны!";
                }
                ?>
            </form>
    </div>
</div>

</body>
</html>