<?php
function db_connect($db): mysqli
{
    $host="recipe-site-db"; # name of mysql container; since UI and DB containers on same docker network, hostnames between containers are the container names
    $db_user="recipe_user";
    $db_password="sug@r&spic3";

    $dblink = new mysqli($host, $db_user, $db_password, $db, 3306); // ODBC string; port is 3306 between containers for mysql

    return $dblink;
}
?>
