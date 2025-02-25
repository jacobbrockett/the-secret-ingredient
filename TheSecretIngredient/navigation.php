<?php
echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">';
echo '<ul class="nav navbar-nav">';

if(isset($_GET['page']))
{
    $page=$_GET['page'];

    switch($page)
    {
        case "login":
            echo '<li><a href="index.php">Home</a></li>';
            echo '<li class="active"><a href="index.php?page=login">Log In</a></li>';
            break;
        default:
            echo '<li class="active"><a href="index.php">Home</a></li>';
            echo '<li><a href="index.php?page=login">Log In</a></li>';
            break;
    }
}
else
{
    echo '<li class="active"><a href="index.php">Home</a></li>';
    echo '<li><a href="index.php?page=login">Log In</a></li>';
}


echo '</ul>';
echo '</div>';
