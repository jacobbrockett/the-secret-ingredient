<div class="container">
    <div class="page-header">
        <h1>BROWSE RECIPES</h1>
        <p>Find a recipe even the pickiest eaters will love!</p>
    </div>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    display_recipes();
    ?>
</div>

<?php

function display_recipes(): void
{
    include("./helpers/database_helpers.php");
    $dblink = db_connect("recipe-db");

    $sql = "select recipes.title as 'Title', recipes.Description as 'Description', users.first_name as 'First_Name', users.last_name as 'Last_Name' from recipes INNER JOIN users ON recipes.user_id=users.id;";
    $results = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    while ($info = $results->fetch_array(MYSQLI_ASSOC)) {
        echo '<div class="panel panel-default">';
        echo '<div class="panel-heading">
                <h2>' . $info['Title'] . '</h2>
                <p><i>By ' . $info['First_Name'] . ' ' . $info['Last_Name'] . '</i></p>
              </div>';
        echo '<div class="panel-body">
                <p>' . $info['Description'] . '</p>
              </div>';
        echo '</div>';
    }
}

?>