<div class="menu" >
    <img src="Картинки/Log.png" align="left">
    <?php
    if (isset($_GET['logged']))
    {
        echo"<li><a href='index.php?logged=1'>Главная</a></li>";
    }else{
        echo"<li><a href='index.php'>Главная</a></li>";
    }
    ?>

    <li><a href="info.php">О нас</a></li>
    <li><a href='Index.php'>Выйти</a></li>
</div>