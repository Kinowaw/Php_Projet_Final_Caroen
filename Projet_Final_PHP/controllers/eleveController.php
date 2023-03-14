<?php
require 'C:\Users\Panda\Desktop\Projet_Final_PHP\models\eleves.php';

class EleveController extends Eleves
{
    private $eleve;

    public function __construct()
    {
        parent::__construct();
        $this->eleve = new Eleves();
    }

    public function createEleve()
    {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $age = $_POST['age'];

        $this->eleve->creerEleve($nom, $prenom, $email, $age);
    }

    public function getElevee()
    {
        $prenom = $_POST['prenom'];
        $eleve = $this->eleve->fetchByPrenom($prenom);
        return $eleve;
    }

    public function updateEleve()
    {
        $id = $_POST['id'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
    }
}
