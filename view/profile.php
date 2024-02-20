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
    <div id="content-profile">
        <h1>Mon profil</h1>
        <h2>Mes informations</h2>
        <div id="profile" >
            <table>
                    <tr>
                        <td>
                            <p>Prénom</p>
                        </td>
                        <td>
                            <p class="profile-info"><?= $_SESSION['firstname'];?></p>
                        </td>
                        <td>
                            <p>Nom</p>
                        </td>
                        <td>
                            <p class="profile-info"><?= $_SESSION['lastname'];?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Email</p>
                        </td>
                        <td>
                            <p class="profile-info"><?= $_SESSION['email'];?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Rôle</p>
                        </td>
                        <td>
                            <p class="profile-info"><?= $_SESSION['role'];?></p>
                        </td>
                        <td>
                            <p>Classe</p>
                        </td>
                        <td>
                            <p class="profile-info"><?= $_SESSION['classe'];?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="classroom" style="margin:0">
                                <a href="/php/liste_eleves_LGXSchool/view/home.php" class="button">Retour à l'accueil</a>
                            </div>
                        </td>
                        <td>
                            <div class="classroom" style="margin:0">
                            <a href="/php/liste_eleves_LGXSchool/view/editPassword.php" class="button">Modifier mon mot de passe</a>                            </div>
                        </td>
                </table>
            </div>
            
        </div> 
        
    </div>
    
  </body>
</html>