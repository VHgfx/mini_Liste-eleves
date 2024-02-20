<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="config/style.css" rel="stylesheet"/>
  </head>
  <body>
    <?php
        require_once(__DIR__.'/view/login.php');
    ?>
  </body>
</html>
