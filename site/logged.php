<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="look5.css"/>
    <title>CinemaJoy</title>
</head>
<body>
<div id="topLogged">
    <div id="topDynLogged">
        <?php
        if (isset($_POST['toLog'])){
            include ("topl.php");
        }
        else {include ("top.php");}
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