<div class = "content">
    <?php
    if (isset($_GET['admin']))
    {
        include("admin.php");
    }
    else
    {
        if (isset($_GET['reg']))
        {
            include ("registrate.php");
        }
        else {
            if (isset($_GET['login']))
            {
                include ("login.php");
            }
            else
            {
                if(isset($_GET['booking'])){
                    include("booking.php");
                }
                else {

                    if (isset($_GET['definedFilm'])) {
                        include("deffilm.php");
                    } else {
                        include("films.php");
                    }
                }
            }
        }
    }
    ?>
</div>