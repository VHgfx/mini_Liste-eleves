<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header("Location: /php/liste_eleves_LGXSchool");
}
if(!isset($_SESSION['role']) || empty($_SESSION['role']) || ($_SESSION['role'] != "Administrateur")){
    header("Location: /php/liste_eleves_LGXSchool/view/home.php");
}

require_once(__DIR__."/../controller/student.php");

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
            $studentCtrl = new StudentCtrl();
            if(isset($_POST['isSendEditStudent'])){
                $result =  $studentCtrl->studentTarget();  
            } 

            if(isset($_POST['isSendEditStudentInfo'])){
                $studentCtrl->studentUpdate(); 
            } 
        ?>
        <h1>Modifier un élève</h1>
        <h2>Informations de l'élève</h2>
            <div id="editStudent-form" >
                <form action="#" method="post">
                    <table>
                        <tr>
                            <td>
                                <label for="prenom">Prénom</label>
                                <input type="text" name="prenom" value="<?=$result[0]['prenom'];?>" required>
                            </td>
                            <td>
                                <label for="nom">Nom de famille</label>
                                <input type="text" name="nom"  value="<?=$result[0]['nom'];?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="niveau-select">Niveau scolaire</label>
                                <select name="niveau-select" id="niveau-select">
                                    <!-- Mettre "selected" dans la balise -->
                                    <option value="">--Sélectionnez un niveau--</option>
                                    <option value="CP" <?= ($result[0]['niveau_scolaire'] == "CP") ? "selected" : "" ?>>CP</option>
                                    <option value="CE1" <?= ($result[0]['niveau_scolaire'] == "CE1") ? "selected" : "" ?>>CE1</option>
                                    <option value="CE2" <?= ($result[0]['niveau_scolaire'] == "CE2") ? "selected" : "" ?>>CE2</option>
                                </select>
                            </td>
                            <td>
                                <label for="date_naissance">Date de naissance</label>
                                <input type="date" id="naissance" name="date_naissance" value="<?=$result[0]['date_naissance'];?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div>
                                    <legend>L'élève présente-t-il un handicap ?</legend>
                                
                                    <input type="radio" id="handicap-false" name="handicap-bool" value="0" <?= (empty($result[0]['handicap'])) ? "checked" : "" ?>/>
                                    <label for="handicap-false">Non</label>   
                                    <input type="radio" id="handicap-true" name="handicap-bool" value="1" <?= (!empty($result[0]['handicap'])) ? "checked" : "" ?>/>
                                    <label for="handicap-true">Oui</label>                                
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="classroom" style="margin:0">
                                    <a href="/php/liste_eleves_LGXSchool/view/home.php" class="button">Retour à l'accueil</a>
                                </div>
                            </td>
                            <td colspan="2">
                                <label for="handicap-description">Si oui, quelle est la nature de son handicap ?</label>
                                <input type="text" name="handicap-description" value="<?=$result[0]['handicap'];?>">
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="studentId" value="<?=$result[0]['id'];?>"></input>
                    <input type="submit" value="Modifier les informations de l'élève" name="isSendEditStudentInfo">
                </form>
            </div>
    </div> 
  </body>
</html>