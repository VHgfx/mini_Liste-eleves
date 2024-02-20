<?php

require_once(__DIR__.'/../config/db.php');

class Teacher extends Database {
    public $id;
    public $teacherFirstname;
    public $teacherLastname;
    public $teacherEmail;
    public $teacherRole;
    public $teacherPassword;
    public $teacherClasse;
    public $teacherIsAdmin;

    public function checkExistingTeacher() : bool{
             
        $checkQuery = "SELECT count(*) FROM `enseignants` where email = :email AND password = :password";

        $stmt = $this->db->prepare($checkQuery);
        $stmt -> bindValue(':email', $this->teacherEmail, PDO::PARAM_STR);
        $stmt -> bindValue(':password', $this->teacherPassword, PDO::PARAM_STR);
        $stmt -> execute();
    
        $count = $stmt->fetchColumn();
    
        /* if($count > 1){
            return true;
        } else {
            return false;
        } peut être résumé en : */
        return ($count >= 1);
    }

    public function teacherTarget(){
        $currentQuery = "SELECT * FROM `enseignants` WHERE `email` = :email";
        $stmt = $this->db->prepare($currentQuery);
        $stmt->bindValue(":email", $this->teacherEmail, PDO::PARAM_STR);
        $stmt->execute();

        $resultTarget = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultTarget;
    }

    public function checkPassword(){
        $checkQuery = "SELECT password FROM Enseignants WHERE email = :email";

        $stmt = $this->db->prepare($checkQuery);
        $stmt -> bindValue(':email', $this->teacherEmail, PDO::PARAM_STR);
        $stmt -> execute();
    
        $dbPassword = $stmt->fetchColumn();
    
        if($this->teacherPassword == $dbPassword){
            return true;
        } else {
            return false;
        }
        
    }

    public function updatePassword(){
        $updateQuery = "UPDATE Enseignants SET password = :password WHERE email = :email";

        $stmt = $this->db->prepare($updateQuery);
        $stmt -> bindValue(':email', $this->teacherEmail, PDO::PARAM_STR);
        $stmt -> bindValue(':password', $this->teacherPassword, PDO::PARAM_STR);

        $stmt -> execute();

        echo "Mot de passe mis à jour !";
    }

    public function teacherUpdate(){
        $updateQuery = "UPDATE `enseignants` SET `password` = :password WHERE `email` = :email";
        $stmt = $this->db->prepare($updateQuery);
        
        $stmt->bindValue(":password", $this->teacherPassword, PDO::PARAM_STR);

        $stmt->bindValue(":email", $this->teacherEmail, PDO::PARAM_INT);
        $stmt->execute();

        echo "Mot de passe mis à jour !";
    }

}