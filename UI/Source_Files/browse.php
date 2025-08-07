<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Browse Recipes</h2>
        </div>
        <div class="panel-body">
            <p>Find a recipe even the pickiest eaters will love!</p>
        </div>
        <div>
            <table style="width:100%">
                <tbody>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>User First Name</th>
                    <th>User Last Name</th>
                </tr>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                include("./helpers/database_helpers.php");
                $dblink = db_connect("recipe-db");

                $sql = "select recipes.title as 'Title', recipes.Description as 'Description', users.first_name as 'First_Name', users.last_name as 'Last_Name' from recipes INNER JOIN users ON recipes.user_id=users.id;";
                $results = $dblink->query($sql) or die("<h2>Something went wrong with $sql<br>" . $dblink->error . "</h2>");

                while ($info = $results->fetch_array(MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td>$info[Title]</td>";
                    echo "<td>$info[Description]</td>";
                    echo "<td>$info[First_Name]</td>";
                    echo "<td>$info[Last_Name]</td>";
                    echo "</tr>";
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>