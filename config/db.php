<?php 

class Database {
    protected $db;


    public function __construct(){
        try {
            $this->db= new PDO ('mysql:host=localhost;dbname=cda_liste_eleves;charset=utf8','root','');
        } catch (Exception $e) {
            die ('Erreur :'. $e->getMessage());
        }
    }
}
