<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header("Location: /php/liste_eleves_LGXSchool");
}
require_once(__DIR__."/../controller/student.php");

?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../config/style.css" rel="stylesheet"/>
  </head>

    <div id="list">
        <?php
            $studentCtrl = new StudentCtrl();
            if(isset($_POST['isSendEditStudent'])){
                $studentCtrl->studentUpdate();
            } 

            if(isset($_POST['isSendDeleteStudent'])){
                $studentCtrl->studentDelete();
            } 
        ?>
        <h1>Liste des élèves</h1>
        <?php if(($_SESSION['role'] === "Administrateur") || ($_SESSION['classe'] === "A")) :?>
        <div class="classroom">
            <h2>Classe A</h2>
            <div class="classe-composition">
                <?php if(($_SESSION['role'] === "Administrateur")) :?>
                    <a href="/php/liste_eleves_LGXSchool/view/addStudent.php" class="button">Ajouter un élève</a>
                <?php endif;?>

                <table>
                    <thead>
                        <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Niveau scolaire</th>
                        <th>Date de naissance</th>
                        <th>Handicap</th>
                        <th>Détails du handicap</th>
                        <?php if(($_SESSION['role'] === "Administrateur")) :?>
                            <th>Editer</th>
                            <th>Supprimer</th>
                        <?php endif;?>

                        </tr>
                    </thead>
                    <?php $results = $studentCtrl->studentListA(); 
    
                    foreach ($results as $result): ?>
                    <?php if(empty($result['handicap'])){
                        $isHandicap = 'Non';
                    } else {
                        $isHandicap = 'Oui';
                    }?>
                        <tr>
                            <td><?=$result['nom'];?></td>
                            <td><?=$result['prenom'];?></td>
                            <td><?=$result['niveau_scolaire'];?></td>
                            <td><?=$result['date_naissance'];?></td>
                            <td><?=$isHandicap;?></td>
                            <td><?=$result['handicap'];?></td>
                            <?php if(($_SESSION['role'] === "Administrateur")) :?>
                                <td>
                                    <form action="/php/liste_eleves_LGXSchool/view/editStudent.php" method="post">
                                        <input type="hidden" name="isSendEditStudent" target="_self" value="Edit"></input>
                                        <input type="hidden" name="studentId" value="<?=$result['id'];?>"></input>
                                        <input type="image" src="../config/crayon.png" alt="Editer les informations de <?=$result['nom'];?> <?=$result['prenom'];?>">
                                    </form>
                                </td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="isSendDeleteStudent" target="_self" value="X"></input>
                                        <input type="hidden" name="studentId" value="<?=$result['id'];?>"></input>
                                        <input type="image" src="../config/effacer.png" alt="Supprimer définitivement <?=$result['nom'];?> <td><?=$result['prenom'];?>">
                                    </form>
                                </td>
                            <?php endif;?>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
        <?php endif;?>
        <?php if(($_SESSION['role'] === "Administrateur") || ($_SESSION['classe'] === "B")) :?>
        <div class="classroom">
            <h2>Classe B</h2>
            <div class="classe-composition">
            <?php if(($_SESSION['role'] === "Administrateur")) :?>
                <a href="/php/liste_eleves_LGXSchool/view/addStudent.php" class="button">Ajouter un élève</a>
            <?php endif;?>

            <table>
                    <thead>
                        <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Niveau scolaire</th>
                        <th>Date de naissance</th>
                        <th>Handicap</th>
                        <th>Détails du handicap</th>
                        <?php if(($_SESSION['role'] === "Administrateur")) :?>
                            <th>Editer</th>
                            <th>Supprimer</th>
                        <?php endif;?>
                        </tr>
                    </thead>
                    <?php $results = $studentCtrl->studentListB(); 
    
                    foreach ($results as $result): ?>
                    <?php if(empty($result['handicap'])){
                        $isHandicap = 'Non';
                    } else {
                        $isHandicap = 'Oui';
                    }?>
                        <tr>
                            <td><?=$result['nom'];?></td>
                            <td><?=$result['prenom'];?></td>
                            <td><?=$result['niveau_scolaire'];?></td>
                            <td><?=$result['date_naissance'];?></td>
                            <td><?=$isHandicap;?></td>
                            <td><?=$result['handicap'];?></td>
                            <?php if(($_SESSION['role'] === "Administrateur")) :?>
                            <td>
                                <form action="/php/liste_eleves_LGXSchool/view/editStudent.php" method="post">
                                    <input type="hidden" name="isSendEditStudent" target="_self" value="Edit"></input>
                                    <input type="hidden" name="studentId" value="<?=$result['id'];?>"></input>
                                    <input type="image" src="../config/crayon.png" alt="Editer les informations de <?=$result['nom'];?> <?=$result['prenom'];?>">
                                </form>
                            </td>
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="isSendDeleteStudent" target="_self" value="X"></input>
                                    <input type="hidden" name="studentId" value="<?=$result['id'];?>"></input>
                                    <input type="image" src="../config/effacer.png" alt="Supprimer définitivement <?=$result['nom'];?> <td><?=$result['prenom'];?>">
                                </form>
                            </td>
                            <?php endif;?>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>