<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="l.css"/>
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
    <div id ="contentbar">
        <?php
        include ("contentbar.php");
        ?>
    </div>
</body>
</html>