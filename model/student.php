<?php

require_once(__DIR__.'/../config/db.php');

class Student extends Database {
    public $id;
    public $studentFirstname;
    public $studentLastname;
    public $studentLevel;
    public $studentBirthdate;
    public $studentIsHandicap;
    public $studentHandicap;


    public function studentAdd(){
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

    public function studentListB(){
        $listQuery = "SELECT * FROM `eleves` WHERE niveau_scolaire='CE2'";
        $stmt = $this->db->prepare($listQuery);
        $stmt->execute();

        $resultsB = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
        return $resultsB;
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

    public function studentUpdate(){
        $updateQuery = "UPDATE `eleves` SET `nom` = :nom, `prenom` = :prenom, `niveau_scolaire` = :niveau_scolaire, `date_naissance` = :date_naissance, `handicap` = :handicap WHERE `id` = :id";
        $stmt = $this->db->prepare($updateQuery);
        
        $stmt->bindValue(":nom", $this->studentLastname, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $this->studentFirstname, PDO::PARAM_STR);
        $stmt->bindValue(":niveau_scolaire", $this->studentLevel, PDO::PARAM_STR);
        $stmt->bindValue(":date_naissance", $this->studentBirthdate, PDO::PARAM_STR);
        $stmt->bindValue(":handicap", $this->studentHandicap, PDO::PARAM_STR);

        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();

        echo "Informations de l'élève mises à jour !";
    }

    public function studentTarget(){
        $currentQuery = "SELECT * FROM `eleves` WHERE `id` = :id";
        $stmt = $this->db->prepare($currentQuery);
        $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
        $stmt->execute();

        $resultTarget = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultTarget;
    }

    public function checkExistingStudent() : bool{
             
        $checkQuery = "SELECT count(*) FROM `eleves` where UPPER(nom) = :nom AND UPPER(prenom) = :prenom AND date_naissance = :date_naissance";

        $formatPrenom= strtoupper($this->studentFirstname);
        $formatNom = strtoupper($this->studentLastname);

        $stmt = $this->db->prepare($checkQuery);
        $stmt -> bindValue(':nom', $formatNom, PDO::PARAM_STR);
        $stmt -> bindValue(':prenom', $formatPrenom, PDO::PARAM_STR);
        $stmt -> bindValue(':date_naissance', $this->studentBirthdate, PDO::PARAM_STR);
        $stmt -> execute();
    
        $count = $stmt->fetchColumn();
    
        /* if($count > 1){
            return true;
        } else {
            return false;
        } peut être résumé en : */
        return ($count >= 1);
    }
}