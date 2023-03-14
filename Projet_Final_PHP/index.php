<?php

//ROOTER

//on démarre une nouvelle session
session_start();

//Connection à la base de données
require 'C:\Users\Panda\Desktop\Projet_Final_PHP\config\Database.php';

require 'C:\Users\Panda\Desktop\Projet_Final_PHP\controllers\eleveController.php';

//Instanciation des controllers
$eleveController = new EleveController();

// $request = $_SERVER["REQUEST_URI"];

//Switch pour les url
// switch($request){
//     case '/':
//         require __DIR__ . "/templates/home.phtml";
//         break;
//     case '/register':
//         require __DIR__ . "/templates/user/register.phtml";
//         // $userController->createAccount();
//         break;
//     case '/create':
//         $userController->createAccount();
//     default:
//         http_response_code(404);
//         require __DIR__ . "/templates/404.phtml";
//         break;
// }

if (array_key_exists('action', $_GET)) {
    switch ($_GET['action']) {
        case 'register':
            require __DIR__ . "/view/eleves/add.phtml";
            break;
        case 'create':
            $eleveController->createEleve();
            require __DIR__ . "/view/eleves/edit.phtml";
            break;
        case 'edit':
            $eleveController->getElevee();
            require __DIR__ . "/view/eleves/edit.phtml";
            break;
        case 'edit':
            $eleveController->updateEleve();
            require __DIR__ . "/view/eleves/edit.phtml";
            break;
    }
} else {
    require __DIR__ . "/view/home.phtml";
}
