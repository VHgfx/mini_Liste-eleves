<?php 
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
  header("Location: /php/liste_eleves_LGXSchool");
}

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../config/style.css" rel="stylesheet"/>
    <title>Accueil - LGX School</title>
  </head>
  <body>
    <?php
        require_once(__DIR__.'/bars.php');
    ?>
    <div id="content">
        <?php
            require_once(__DIR__.'/list.php');
        ?>
   </div> 
  </body>
</html>
