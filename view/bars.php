<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
} 


if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header("Location: /php/liste_eleves_LGXSchool");
}

require_once(__DIR__."/../controller/teacher.php");
$teacherCtrl = new TeacherCtrl();

if(isset($_POST['isSendDisconnect'])){
    $teacherCtrl->teacherDisconnect();
} 
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../config/style.css" rel="stylesheet"/>
  </head>
  <body>
    <div id="headbar">
        <h1 style="color: white">LGX School</h1>
    </div>
    <div id="sidebar">
      <div class="sidebar-button">
        <a href="/php/liste_eleves_LGXSchool/view/home.php" class="sidebar-button">Accueil</a>
      </div>
      <?php if(($_SESSION['role'] === "Administrateur")) :?>
        <div class="sidebar-button">
          <a href="/php/liste_eleves_LGXSchool/view/addStudent.php" class="sidebar-button">Ajouter un élève</a>
        </div>
      <?php endif;?>

      <div class="sidebar-button">
        <a href="/php/liste_eleves_LGXSchool/view/profile.php" class="sidebar-button">Mon profil</a>
      </div>
      <div id="bottom-sidebar">
        <div class="bottom-button">
          <a href="/php/liste_eleves_LGXSchool/view/profile.php" class="bottom-button"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'];?></a>
        </div>
        <div class="bottom-button">
          <form action="#" method="post">
              <input type="submit" value="Se déconnecter" name="isSendDisconnect" class="button">
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
