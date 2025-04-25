<?php
// Navbar Component
echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">';
echo '<ul class="nav navbar-nav">';

// Function for setting active page:
function active_page($active_page = 'index'): void
{
    echo '<li'. ($active_page === 'index' ? ' class="active"' : '') . '><a href="index.php">Home</a></li>';
    echo '<li'. ($active_page === 'browse' ? ' class="active"' : '') . '><a href="index.php?page=browse">Browse</a></li>';
    echo '<li'. ($active_page === 'profile' ? ' class="active"' : '') . '><a href="index.php?page=profile">Profile</a></li>';
    echo '<li'. ($active_page === 'login' ? ' class="active"' : '') . '><a href="index.php?page=login">Log In</a></li>';
}

// Check which page currently on
if(isset($_GET['page']))
{
    $page=$_GET['page']; // get page currently on

    active_page($page); // set navbar tab for page active
}
else
{
    active_page(); // default page tab active
}


echo '</ul>';
echo '</div>';
