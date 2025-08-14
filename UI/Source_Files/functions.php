<?php

use JetBrains\PhpStorm\NoReturn;

#[NoReturn] function redirect($uri): void
{ ?>
    <script type="text/javascript">
        document.location.href="<?php echo $uri; ?>";
    </script>
    <?php die;
}
?>