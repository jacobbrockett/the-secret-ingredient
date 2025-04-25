<?php

use JetBrains\PhpStorm\NoReturn;

function db_connect($db): mysqli
{
    $host="localhost";
    $db_user="webuser";
    $db_password="l*p1Kan_RKTad8(R";

    $dblink = new mysqli($host, $db_user, $db_password, $db); // ODBC string

    return $dblink;
}

#[NoReturn] function redirect($uri): void
{ ?>
    <script type="text/javascript">
        document.location.href="<?php echo $uri; ?>";
    </script>
    <?php die;
}
?>