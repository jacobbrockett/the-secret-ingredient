<?php
function db_connect($db): mysqli
{
    $env=parse_ini_file("database.env");

    $host=$env["DB_CONTAINER_HOSTNAME"]; # name of mysql container; since UI and DB containers on same docker network, hostnames between containers are the container names
    $db_user=$env["DB_USERNAME"];
    $db_password=$env["DB_PASSWORD"];

    $dblink = new mysqli($host, $db_user, $db_password, $db, 3306); // ODBC string; port is 3306 between containers for mysql

    return $dblink;
}
?>
