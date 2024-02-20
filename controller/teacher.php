<?php
require_once(__DIR__.'/../config/db.php');
require_once(__DIR__."/../model/teacher.php");

class TeacherCtrl extends Database {
    public function teacherLogin(){
        $error = false;

        if ((isset($_POST['isSendLogin']) && !empty($_POST['isSendLogin']))){

            $teacher = new Teacher();
            if (isset($_POST['email']) && !empty($_POST['email'])){
                $teacher->teacherEmail = $_POST["email"];
            } else {
                echo "Veuillez entrer un email";
                $error = true;
            }
            
            if (isset($_POST["password"]) && !empty($_POST["password"])){
                $teacher->teacherPassword = $_POST["password"];
            } else {
                echo "Veuillez entrer votre mot de passe";
                $error = true;
            }


            if($error == false){
                if($teacher->checkExistingTeacher()){
                    $result = $teacher->teacherTarget();

                    $_SESSION['role'] = $result[0]['role'];
                    $_SESSION['firstname'] = $result[0]['prenom'];
                    $_SESSION['lastname'] = $result[0]['nom'];
                    $_SESSION['email'] = $result[0]['email'];
                    $_SESSION['classe'] = $result[0]['classe'];

                    header("Location: /php/liste_eleves_LGXSchool/view/home.php");
                } else {
                    echo "Il y a eu une erreur, veuillez recommencer.";
                }
            }         
        }
    }

    public function teacherDisconnect(){
        if(isset($_POST['isSendDisconnect']) && !empty($_POST['isSendDisconnect'])){
            if(isset($_SESSION['email']) || !empty($_SESSION['email'])){
                session_destroy();
    
                header("Location: /php/liste_eleves_LGXSchool");
                exit;
    
            }
        }       
    }


    public function teacherUpdatePassword(){
        $error = false;

        if ((isset($_POST['isSendEditPassword']) && !empty($_POST['isSendEditPassword']))){

            $teacher = new Teacher();

            if (isset($_POST['old_password']) && !empty($_POST['old_password'])){
                $error = false;
            } else {
                echo "Veuillez entrer votre mot de passe actuel";
                $error = true;
            }

            if (isset($_POST['new_password']) && !empty($_POST['new_password'])){
                $error = false;
            } else {
                echo "Veuillez entrer votre nouveau mot de passe";
                $error = true;
            }
            
            if (isset($_POST['confirm_password']) && !empty($_POST['confirm_password'])){
                $error = false;
            } else {
                echo "Veuillez confirmer votre mot de passe";
                $error = true;
            }

            if($_POST['old_password'] == $_POST['new_password']){
                $error = true;
                echo "Veuillez entrer un mot de passe différent de l'ancien";
            } 

            if($_POST['confirm_password'] != $_POST['new_password']){
                $error = true;
                echo "Veuillez confirmer le mot de passe en l'entrant à l'identique";
            } 

            if($error == false){
                $teacher->teacherPassword = $_POST['old_password'];
                $teacher->teacherEmail = $_SESSION['email'];
                $comparedPassword = $teacher->checkPassword();
                if($comparedPassword){
                    $teacher->teacherPassword = $_POST['new_password'];
                    $teacher->updatePassword();
                    
                }
            }
  
        }
    }

}