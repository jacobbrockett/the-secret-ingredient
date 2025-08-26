<div class="container">
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    // TODO: Get ID of User:
    //        $user_id = $_GET['user_id'];
    $user_id = "2";
    ?>

    <div class="page-header">
        <h1>Profile</h1>
        <div class="row">
            <div class="col-md-4">
                <img src="assets/images/swole_mordecai.jpg" alt="Image of the Regular Show character Mordecai"
                     style="width:171px;height:180px;">
            </div>
            <div class="col-md-8">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu volutpat velit. Sed ut finibus sapien.
                    In sed ornare sapien, nec pharetra quam. Pellentesque habitant morbi tristique senectus et netus et
                    malesuada fames ac turpis egestas. Praesent aliquet felis et libero tincidunt vulputate. Maecenas id
                    sapien congue, luctus massa dignissim, porttitor nibh. Nunc et lobortis risus, vitae pulvinar risus.
                    Proin consectetur consectetur sollicitudin. Donec ut tristique ligula, non suscipit odio. Quisque
                    sagittis ornare vestibulum. Pellentesque elementum nisi vitae lectus mollis aliquam eget pulvinar
                    sapien. Etiam ut eros scelerisque risus pulvinar sodales. Duis luctus imperdiet risus, vel pretium
                    diam porta egestas. Sed pellentesque egestas lectus eget semper.</p>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h1>Contact Information</h1>
        <?php
        // Fetch user information from database:
        $user_results = fetch_contact_information($user_id);
        if ($user_results){
            $db_user = $user_results->fetch_array(MYSQLI_ASSOC);
        ?>

        <h3>Name</h3>
        <?php
            echo '<p>' . $db_user['First_Name'] . ' ' . $db_user['Last_Name'] . '</p>';
        ?>

        <h3>Email</h3>
        <?php
            echo '<p>' . $db_user['Email'] . '</p>';
        ?>

        <h3>Phone Number</h3>
        <?php
            echo '<p>' . $db_user['Phone_Number'] . '</p>';
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
        $results = fetch_uploaded_recipes($user_id);

        // Display the recipes:
        if ($results) {
            while ($db_recipe = $results->fetch_array(MYSQLI_ASSOC)) {
                display_recipe($db_recipe);
            }
        }
        ?>
    </div>

    <div class="page-header">
        <h1>Favorite Recipes</h1>
        <p>View list of condensed recipes user has "saved"</p>
        <!--        TODO: add functionality to "unsave" recipes-->
    </div>

</div>

<?php
function fetch_contact_information($user_id): bool|mysqli_result
{
    include("./helpers/database_helpers.php");
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