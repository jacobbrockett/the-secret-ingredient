<div class="container">
    <div class="page-header">
        <h1>BROWSE RECIPES</h1>
        <p>Find a recipe even the pickiest eaters will love!</p>
    </div>
    <?php
//        error_reporting(E_ALL);
//        ini_set('display_errors', 1);

        // Fetch recipes from database:
        $results = fetch_recipes();

        // Display the recipes:
        if ($results)
        {
            while ($db_recipe = $results->fetch_array(MYSQLI_ASSOC))
            {
                display_recipe($db_recipe);
            }
        }

    ?>
</div>

<?php
    function fetch_recipes(): bool|mysqli_result
    {
        include("./helpers/database_helpers.php");
        $dblink = db_connect("recipe-db");

        $sql = "select recipes.id as 'Id', recipes.title as 'Title', recipes.Description as 'Description', users.first_name as 'First_Name', users.last_name as 'Last_Name' from recipes INNER JOIN users ON recipes.user_id=users.id;";
        $results = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

        return $results;
    }

    function display_recipe($db_recipe): void
    {
        echo '<div class="panel panel-default">';
        echo '<div class="panel-heading">
                <h2>' . $db_recipe['Title'] . '</h2>
                <p><i>By ' . $db_recipe['First_Name'] . ' ' . $db_recipe['Last_Name'] . '</i></p>
              </div>';
        echo '<div class="panel-body">
                <p>' . $db_recipe['Description'] . '</p>
                <p><a class="btn btn-default" href="index.php?page=recipe&id=' . $db_recipe['Id'] . '" role="button">View</a></p>
              </div>';
        echo '</div>';
    }
?>