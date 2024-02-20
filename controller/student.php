<?php
require_once(__DIR__.'/../config/db.php');
require_once(__DIR__."/../model/student.php");

class StudentCtrl extends Database {
    public function studentAdd(){
        $error = false;

        if (count($_POST) > 0){
            $student = new Student();

            if (!empty($_POST['prenom'])){
                if (preg_match("/^[- '\p{L}]+$/u", $_POST["prenom"])){
                    $student->studentFirstname = $_POST["prenom"];
                } else {
                    echo "Veuillez entrer un nom valide";
                    $error = true;
                }
            } else {
                echo "Veuilez entrer le prénom de l'élève";
                $error = true;
            }

            if (!empty($_POST["nom"])){
                if (preg_match("/^[- '\p{L}]+$/u", $_POST["nom"])){
                    $student->studentLastname = $_POST["nom"];
                } else {
                    echo "Veuillez entrer un nom valide";
                    $error = true;
                }
            } else {
                echo "Veuilez entrer le nom de l'élève";
                $error = true;
            }

            if (!empty($_POST['niveau-select'])){
                $student->studentLevel = $_POST["niveau-select"];
            } else {
                echo "Veuilez sélectionner le niveau scolaire de l'élève";
                $error = true;
            }

            if (!empty($_POST['date_naissance'])){
                $student->studentBirthdate = $_POST["date_naissance"];
            } else {
                echo "Veuilez indiquer la date de naissance de l'élève";
                $error = true;
            }

            if ($_POST['handicap-bool'] == 0){
                $student->studentHandicap = "";
            } else {
                $student->studentHandicap = $_POST["handicap-description"];
            }

            

            if($error == false){
                if($student->checkExistingStudent()){
                    $error = true;
                    echo '<script>
                        alert("Un élève identique existe déjà !");
                    </script>';
                } else {
                    if($error == false){
                        $student->studentAdd();
                    }
                }
            }         
        }
    }

    public function studentListA(){
        $student = new Student();

        return $student->studentListA();
    }

    public function studentListB(){
        $student = new Student();

        return $student->studentListB();
    }

    public function studentTarget(){
        $error = false;
        $student = new Student();

        if (isset($_POST['isSendEditStudent']) && !empty($_POST['isSendEditStudent'])){
            $student->id = $_POST["studentId"];

            return $student->studentTarget();
        } else {
            echo "L'élève n'existe pas dans la base de données";
            $error = true;
        }
    }

    public function studentUpdate(){
        $error = false;
        $student = new Student();

        if (isset($_POST['isSendEditStudentInfo']) && !empty($_POST['isSendEditStudentInfo'])){
            $student->id = $_POST["studentId"];

            if (isset($_POST['nom']) && !empty($_POST['nom'])){
                $student->studentLastname = $_POST["nom"];
            } else {
                echo "Veuillez entrer un nom";
                $error = true;
            }

            if (isset($_POST['prenom']) && !empty($_POST['prenom'])){
                $student->studentFirstname = $_POST["prenom"];
            } else {
                echo "Veuillez entrer un prénom";
                $error = true;
            }

            if (isset($_POST['date_naissance']) && !empty($_POST['date_naissance'])){
                $student->studentBirthdate = $_POST["date_naissance"];
            } else {
                echo "Veuillez entrer une date de naissance";
                $error = true;
            }


            if (isset($_POST['niveau-select']) && !empty($_POST['niveau-select'])){
                $student->studentLevel = $_POST["niveau-select"];
            } else {
                echo "Veuillez entrer un niveau";
                $error = true;
            }

            if ($_POST['handicap-bool'] == 0){
                $student->studentHandicap = "";
            } else {
                $student->studentHandicap = $_POST["handicap-description"];
            }
            
            if($error == false) {
                $student->studentUpdate();
                header("Location: /php/liste_eleves_LGXSchool/view/home.php");
                echo "Les informations ont été mises à jour";

            } else {
                echo "Une erreur s'est produite";
            }
        }
        
    }

    public function studentDelete(){
        if (isset($_POST['isSendDeleteStudent']) && !empty($_POST['isSendDeleteStudent'])){
            $student = new Student();
            $student->id = $_POST["studentId"];

            $student->studentDelete();
        }
    }


}