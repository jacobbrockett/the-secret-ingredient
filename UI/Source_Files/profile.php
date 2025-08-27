<div class="container">
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // TODO: Get ID of User:
    //        $user_id = $_GET['user_id'];
    $user_id = "1";
    ?>

    <div class="page-header">
        <h1>Profile</h1>
        <?php
        // Fetch contact information from database:
        $profile_results = fetch_user_profile($user_id);
        if ($profile_results){
            $db_profile = $profile_results->fetch_array(MYSQLI_ASSOC);
        ?>
        <div class="row">
            <div class="col-md-4">
            <?php
            if (isset($db_profile['Path'])) {
                echo '<img src="' . $db_profile['Path'] . '" alt="User profile picture" style="width:171px;height:180px;"/>';
            }
            else {
                echo '<a href="https://www.flaticon.com/free-icons/user" title="user icons">
                        <figure>
                            <img src="assets/images/user.png" alt="User profile picture" style="width:171px;height:180px;">
                            <figcaption>User icons created by Freepik - Flaticon</figcaption>
                        </figure>
                      </a>';
            }
            ?>
            </div>
            <div class="col-md-8">
            <?php
            if (isset($db_profile['Bio'])) {
                echo '<p>' . $db_profile['Bio'] . '</p>';
            }
            else {
                echo '<p>No Bio</p>';
            }
            ?>
            </div>
        <?php
        }
        ?>
        </div>
    </div>

    <div class="page-header">
        <h1>Contact Information</h1>
        <?php
        // Fetch contact information from database:
        $contact_results = fetch_contact_information($user_id);
        if ($contact_results){
            $db_contact = $contact_results->fetch_array(MYSQLI_ASSOC);
        ?>

        <h3>Name</h3>
        <?php
            echo '<p>' . $db_contact['First_Name'] . ' ' . $db_contact['Last_Name'] . '</p>';
        ?>

        <h3>Email</h3>
        <?php
            echo '<p>' . $db_contact['Email'] . '</p>';
        ?>

        <h3>Phone Number</h3>
        <?php
            echo '<p>' . $db_contact['Phone_Number'] . '</p>';
        }
        ?>

        <br>
        <button type="button" class="btn btn-default btn-lg">Edit</button>
    </div>

    <div class="page-header">
        <h1>Uploaded Recipes</h1>
        <p>View list of condensed recipes user has uploaded</p>
        <?php
        // Fetch recipes from database:
        $uploaded_results = fetch_uploaded_recipes($user_id);

        // Display the recipes:
        if ($uploaded_results) {
            while ($db_uploaded = $uploaded_results->fetch_array(MYSQLI_ASSOC)) {
                display_recipe($db_uploaded);
            }
        }
        ?>
    </div>

    <div class="page-header">
        <h1>Favorite Recipes</h1>
<!--        TODO: Fetch 'saved' recipes-->
        <p>View list of condensed recipes user has "saved"</p>

        <!--        TODO: add functionality to "unsave" recipes-->
    </div>

</div>

<?php

function fetch_user_profile($user_id): bool|mysqli_result
{
    include("./helpers/database_helpers.php");
    $dblink = db_connect("recipe-db");

    $sql = "select profile.pfp_path as 'Path', profile.bio as 'Bio' from profile where profile.user_id=$user_id";
    $results = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    return $results;
}

function fetch_contact_information($user_id): bool|mysqli_result
{
    $dblink = db_connect("recipe-db");

    $sql = "select id as 'Id', first_name as 'First_Name', last_name as 'Last_Name', email as 'Email', phone_number as 'Phone_Number' from users where id=$user_id;";
    $results = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    return $results;
}
function fetch_uploaded_recipes($user_id): bool|mysqli_result
{
    $dblink = db_connect("recipe-db");

    $sql = "select recipes.id as 'Id', recipes.title as 'Title', recipes.Description as 'Description' from recipes where user_id=$user_id;";
    $results = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

    return $results;
}

function display_recipe($db_recipe): void
{
    echo '<div class="panel panel-default">';
    echo '<div class="panel-heading">
                <h2>' . $db_recipe['Title'] . '</h2>
              </div>';
    echo '<div class="panel-body">
                <p>' . $db_recipe['Description'] . '</p>
                <p><a class="btn btn-default" href="index.php?page=recipe&id=' . $db_recipe['Id'] . '" role="button">View</a></p>
              </div>';
    echo '</div>';
}

?>