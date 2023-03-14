<?php

class Database
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=localhost;dbname=eleves', "root", "");
    }

    public function getBdd()
    {
        return $this->bdd;
    }
}
