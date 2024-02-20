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


    /*public function studentAdd(){
        $addStudentQuery = "INSERT INTO `eleves` (`nom`, `prenom`, `niveau_scolaire`, `date_naissance`, `handicap`) VALUES (:nom, :prenom, :niveau_scolaire, :date_naissance, :handicap)";
        
        $stmt = $this->db->prepare($addStudentQuery);

        $stmt->bindValue(":nom", $this->studentLastname, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $this->studentFirstname, PDO::PARAM_STR);
        $stmt->bindValue(":niveau_scolaire", $this->studentLevel, PDO::PARAM_STR);
        $stmt->bindValue(":date_naissance", $this->studentBirthdate, PDO::PARAM_STR);
        $stmt->bindValue(":handicap", $this->studentHandicap, PDO::PARAM_STR);

        $stmt->execute();

        echo ($this->studentFirstname." ".$this->studentLastname." a été ajouté !");
    }

    public function studentListA(){
        $listQuery = "SELECT * FROM `eleves` WHERE niveau_scolaire='CP' OR niveau_scolaire='CE1'";
        $stmt = $this->db->prepare($listQuery);
        $stmt->execute();

        $resultsA = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
        return $resultsA;
    }


    public function studentDelete(){
        $titleQuery = "SELECT prenom FROM eleves WHERE id = :id";
        $stmt = $this->db->prepare($titleQuery);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $student = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '"'.$student[0]['prenom'].'" a été retiré de la base de données';

        $deleteQuery = "DELETE FROM `eleves` WHERE `id` = :id";
        $stmt = $this->db->prepare($deleteQuery);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();

    }
    */
    public function teacherUpdate(){
        $updateQuery = "UPDATE `enseignants` SET `password` = :password WHERE `email` = :email";
        $stmt = $this->db->prepare($updateQuery);
        
        $stmt->bindValue(":password", $this->teacherPassword, PDO::PARAM_STR);

        $stmt->bindValue(":email", $this->teacherEmail, PDO::PARAM_INT);
        $stmt->execute();

        echo "Mot de passe mis à jour !";
    }

}