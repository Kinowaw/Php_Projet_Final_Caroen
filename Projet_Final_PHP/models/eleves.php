<?php

class Eleves
{
    private $database;
    private $bdd;

    public function __construct()
    {
        $this->database = new Database();
        $this->bdd = $this->database->getBdd();
    }

    //register user
    public function creerEleve($prenom, $nom, $email, $age)
    {
        $query = $this->bdd->prepare("INSERT INTO eleve(prenom,nom,email,age) VALUES (?,?,?,?)");
        try {
            $creerEleve = $query->execute([$prenom, $nom, $email, $age]);
        } catch (Exception $e) {
            print_r($e);
        }
        return $creerEleve;
    }

    public function deleteEleve($id)
    {
        $query = $this->bdd->prepare("DELETE from eleve WHERE prenom = ?");
        try {
            $query->execute([$id]);
            return $query;
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public function getEleve($prenom)
    {
        $query = $this->bdd->prepare("SELECT * FROM eleve WHERE prenom = $prenom");
        try {
            $getEleve = $query->execute([$prenom]);
        } catch (Exception $e) {
            print_r($e);
        }
        $statement = $this->bdd->prepare($query);
        $results = $statement->fetchAll();
        return $results;
    }

    public function fetchByPrenom($prenom)
    {
        $query = $this->bdd->prepare("SELECT * FROM eleve WHERE prenom = ?");
        $query->execute([$prenom]);
        $eleve = $query->fetch();
        return $eleve;
    }
}
