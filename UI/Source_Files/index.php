<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The Secret Ingredient</title>
    <link href="assets/css/bootstrap-theme.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body class="background-page">
<nav class="navbar navbar-default navbar-fixed-top">
    <!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
    <div class="container-fluid navbar-container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">The Secret Ingredient</a>
        </div>

        <?php
        include("navigation.php"); // include page links on the navbar
        ?>
    </div>
</nav>

<?php

if(isset($_GET['page']))
{
    $page=$_GET['page']; // get active page

    // Include the correct file for the active page:
    switch($page)
    {
        case "browse":
            include("browse.php");
            break;
        case "login":
            include("login.php");
            break;
        case "profile":
            include("profile.php");
            break;
        default:
            include("home.php");
            break;
    }
}
else
{
    // Default page:
    include("home.php");
}

?>

</body>
</html>
