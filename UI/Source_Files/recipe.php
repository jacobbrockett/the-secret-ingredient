<div class="container">
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Get ID of Recipe to search for:
    $recipe_id = $_GET['id'];

    echo '<ol class="breadcrumb">
            <li><a href="index.php?page=browse">Browse</a></li>
            <li class="active">' . $recipe_id . '</li>
          </ol>';

    // Fetch recipe from database:
    $result = fetch_recipe($recipe_id);

    // Display the recipe's information:
    if ($result) {
        $db_recipe = $result->fetch_array(MYSQLI_ASSOC);
        display_recipe($db_recipe);
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Ingredients</h4>
        </div>
        <div class="panel-body">
            <ul>
                <?php
                // Fetch Ingredients from database:
                $result = fetch_ingredients($recipe_id);

                // Display Ingredients:
                if ($result) {
                    while ($db_ingredient = $result->fetch_array(MYSQLI_ASSOC)) {
                        display_ingredient($db_ingredient);
                    }
                }

                ?>
            </ul>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Instructions</h4>
        </div>
        <div class="panel-body">
            <ol>
                <?php
                // Fetch Instructions from database:
                $result = fetch_instructions($recipe_id);

                // Display Instructions:
                if ($result) {
                    while ($db_instruction = $result->fetch_array(MYSQLI_ASSOC)) {
                        display_instruction($db_instruction);
                    }
                }

                ?>
            </ol>
        </div>
    </div>
</div>

<?php

function fetch_recipe($recipe_id): bool|mysqli_result
{
    include("./helpers/database_helpers.php");
    $dblink = db_connect("recipe-db");

    $sql = "select recipes.title as 'Title', recipes.Description as 'Description', users.first_name as 'First_Name', users.last_name as 'Last_Name' from recipes INNER JOIN users ON recipes.user_id=users.id where recipes.id=$recipe_id";
    $result = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    return $result;
}

function display_recipe($db_recipe): void
{
    echo '<div class="page-header">
                <h1>' . $db_recipe['Title'] . '</h1>
                <h3><i>By ' . $db_recipe['First_Name'] . ' ' . $db_recipe['Last_Name'] . '</i></h3>
                <br>
                <p>' . $db_recipe['Description'] . '</p>
              </div>';
}

function fetch_ingredients($recipe_id): bool|mysqli_result
{
    $dblink = db_connect("recipe-db");

    $sql = "select ingredients.amount as 'Amount', ingredients.unit as 'Unit', ingredients.ingredient as 'Ingredient' from ingredients where recipe_id=$recipe_id";
    $result = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    return $result;
}

function display_ingredient($db_ingredient): void
{
    echo '<li>' . $db_ingredient['Amount'] . ' ' . $db_ingredient['Unit'] . ' of ' . $db_ingredient['Ingredient'] . '</li>';
}

function fetch_instructions($recipe_id): bool|mysqli_result
{
    $dblink = db_connect("recipe-db");

    $sql = "select instructions.id as 'Id', instructions.description as 'Description' from instructions where recipe_id=$recipe_id order by instructions.id";
    $result = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    return $result;
}

function display_instruction($db_instruction): void
{
    echo '<li>' . $db_instruction['Description'] . '</li>';
}


?>
