<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="look4.css"/>
    <title>CinemaJoy</title>
</head>
<body>
<div id ="filminfo">
    <div id = "leftside">
        <?php
        if(isset($_GET['image'])) {
            echo ("<img src=".$_GET['image']." width='360' height='540' align='centre'>");
        }?>
    </div>
    <div id = "rightside">
        <?php if(isset($_GET['definedFilm'])){
            echo "<h1 align='centre'>".$_GET['definedFilm']."</h1>";
        }
        if(isset($_GET['description'])) {
            echo ($_GET['description']);
        }?>
        <div id = "button">
            <?php
            if(isset($_GET['logged'])){
                echo("<a href='booking.php?logged=1&filmname=".$_GET['definedFilm']."&image=".$_GET['image']."'><img src=\"Картинки\кнопка.jpg\"></a>");
            }
            else{
                echo("<a href='booking.php?filmname=".$_GET['definedFilm']."&image=".$_GET['image']."'><img src=\"Картинки\кнопка.jpg\"></a>");
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>

