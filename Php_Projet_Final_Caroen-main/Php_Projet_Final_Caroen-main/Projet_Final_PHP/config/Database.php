<?php
$dsn = 'mysql:host=localhost;dbname=eleves';
$username = 'root';
//Définition de la source de données afin de se connecter à la base SQL et du nom d'utilisateur

try {
    $db = new PDO($dsn, $username);
} catch (PDOException $e) {
    $error_message = 'Database Error: ';
    $error_message .= $e->getMessage();
    include('C:\Users\Panda\Desktop\Projet_Final_PHP\view\errors\404.phtml');
    exit();
}
//Etablissement de la connexion à la base de donnée, si cela réussit, l'objet PDO est stocké dans la variable $db
//Sinon le bloc catch capture l'erreur et la stocke dans la variable $error_message et inclut une page d'erreur avant de sortir du script avec la fonction exit() empêchant l'exécution d'autre code si la connexion à la base de donnée n'est pas un succès