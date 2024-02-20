<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header("Location: /php/liste_eleves_LGXSchool");
}

require_once(__DIR__."/../controller/teacher.php");

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
    <div id="content-editStudent">
        <?php
            $teacherCtrl = new TeacherCtrl();

            if(isset($_POST['isSendEditPassword'])){
                $teacherCtrl->teacherUpdatePassword(); 
            }
        ?>
            <h1>Modifier mon mot de passe</h1>
            <div id="editStudent-form" >
                <form action="#" method="post">
                    <table>
                        <tr>
                            <td>
                                <label for="old_password">Mot de passe actuel</label>
                            </td>
                            <td>
                                <input type="password" name="old_password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_password">Nouveau mot de passe</label>
                            </td>
                            <td>
                                <input type="password" name="new_password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="confirm_password">Confirmer le mot de passe</label>
                            </td>
                            <td>
                                <input type="password" name="confirm_password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="classroom" style="margin:0">
                                    <a href="/php/liste_eleves_LGXSchool/view/home.php" class="button">Retour à l'accueil</a>
                                </div>
                            </td>
                            <td>
                               <input type="submit" value="Modifier mon mot de passe" name="isSendEditPassword">
                            </td> 
                        </tr>

                    <input type="hidden" name="teacherEmail" value="<?=$_SESSION['email'];?>"></input>
                </form>
            </div>
    </div> 
  </body>
</html>