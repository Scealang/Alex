<?php
if(isset($_GET['genre'])) {
    $curGenre = $_GET['genre'];
    }
else{
    $curGenre = '0';
}
class film
{
    var $filmname;
    var $genre = array();
    var $link;
    var $image;
    var $descr;
    function getImage()
    {
        echo $this->image;
    }
    function getName()
    {
        echo $this->filmname;
    }

    function getLink()
    {
        echo $this->link;
    }
}

if (isset($_POST['submit'])) {
    $film = new film;
    $film->filmname = $_POST['filmName'];
    $film->genre = $_POST['genre'];
    $film->descr = $_POST['descr'];
    $film->image = $_POST['image'];
    $film->link ="deffilm.php?definedFilm=".  $film->filmname."&image=". $film->image."&description=".  $film->descr;
}

$host = 'localhost'; // адрес сервера
$database = 'id9787837_abc'; // имя базы данных
$user = 'id9787837_cinemajoy'; // имя пользователя
$password = ''; // пароль
$link = mysqli_connect($host, $user, $password, $database);
mysqli_query($link,"SET NAMES 'utf8'");
mysqli_query($link,"SET CHARACTER SET 'utf8'");
$sql = mysqli_query($link, "SELECT a, b,c,d FROM abc");
while ($result = mysqli_fetch_array($sql)) {
    if ($curGenre == 0)
    {
        if(isset($_GET['logged'])){
            echo("<div class = " . $result['a'] . "><a href= '" . "index.php?logged=1&definedFilm=" . $result['a'] . "&image=" . $result['c'] . "&description=" . $result['d'] . "'>           
                <img src='" . $result['c'] . "' width='360' height='540' align='centre'>
                </a>
                </div > ");
        }
        else{echo("<div class = " . $result['a'] . "><a href= '" . "index.php?definedFilm=" . $result['a'] . "&image=" . $result['c'] . "&description=" . $result['d'] . "'>           
                <img src='" . $result['c'] . "' width='360' height='540' align='centre'>
                </a>
                </div > ");}

    }
    if ($result['b'] == $curGenre) {
        if(isset($_GET['logged'])) {
            echo("<div class = " . $result['a'] . "><a href= '" . "index.php?logged=1&definedFilm=" . $result['a'] . "&image=" . $result['c'] . "&description=" . $result['d'] . "'>           
                <img src='" . $result['c'] . "' width='360' height='540' align='centre'>
                </a>
                </div > ");
        }
        else
        {
            echo("<div class = " . $result['a'] . "><a href= '" . "index.php?definedFilm=" . $result['a'] . "&image=" . $result['c'] . "&description=" . $result['d'] . "'>           
                <img src='" . $result['c'] . "' width='360' height='540' align='centre'>
                </a>
                </div > ");
        }

    }
}
?>
