<?php
require('C:\Users\Panda\Desktop\Projet_Final_PHP\config\Database.php');
require('C:\Users\Panda\Desktop\Projet_Final_PHP\models\eleves.php');
//On inclut deux fichiers qui contiennent les données et fonctions essentiels au fonctionnement de ce fichier

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nom = filter_input(INPUT_POST, "nom", FILTER_UNSAFE_RAW);
$age = filter_input(INPUT_POST, "age", FILTER_UNSAFE_RAW);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
//On filtre les valeurs afin de s'assurer de l'input de l'utilisateur

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if (!$action) {
        $action = 'add';
    }
}
//La variable action est utilisée afin de déterminer quelle action est demandé à l'utilisateur
//Si elle n'est pas définie dans la méthode POST elle est alors récupérée dans la méthode GET et si elle n'est toujours pas définie alors la valeur par défaut est "add"


$eleve = filter_input(INPUT_POST, "eleve", FILTER_UNSAFE_RAW);
if (!$eleve) {
    $eleve = filter_input(INPUT_GET, "eleve", FILTER_UNSAFE_RAW);
}
//La variable "eleve" stocke le nom de l'eleve afin de facilité la recherche et la modification

switch ($action) {
    case 'insert':
        if (
            $eleve && $nom
            && $age && $email
        ) {
            $count = insert_eleve(
                $eleve,
                $nom,
                $age,
                $email
            );
            header("Location: .?action=select&eleve={$eleve}&created={$count}");
        } else {
            $error_message = 'Données invalide, veuillez remplir à nouveau le formulaire.';
            include('C:\Users\Panda\Desktop\Projet_Final_PHP\view\errors\404.phtml');
        }
        break;
        //Les données de l'eleve sont vérifiées et si elles sont valides, la fonction est appelé pour insérer les données dans la base de données
        //L'utilisateur est alors redrigé vers une page lui informant que la création est un succès

    case 'select':
        if ($eleve) {
            $results = select_eleve_by_name($eleve);
            include('C:\Users\Panda\Desktop\Projet_Final_PHP\view\eleves\edit.phtml');
        } else {
            $error_message = 'Invalid eleve data. Check all fields and resubmit.';
            include('C:\Users\Panda\Desktop\Projet_Final_PHP\view\errors\404.phtml');
        }
        break;
        //La fonction est appelée pour récupérer les données de l'eleve et les afficher sur la page de modification


    case 'update':
        if (
            $id && $eleve && $nom
            && $age && $email
        ) {
            $count = update_eleve(
                $id,
                $eleve,
                $nom,
                $age,
                $email
            );
            header("Location: .?action=select&eleve={$eleve}&updated={$count}");
        } else {
            $error_message = 'Invalid eleve data. Check all fields and resubmit.';
            include('C:\Users\Panda\Desktop\Projet_Final_PHP\view\errors\404.phtml');
        }
        break;
        //les données de l'lève sont vérifiés et si elles sont valides la fonction est appelée pour mettre a jour les données
        //L'utilisateur est alors redrigé vers une page lui informant que la modification est un succès


    case 'delete':
        if ($id) {
            $count = delete_eleve($id);
            header("Location: .?deleted={$count}");
        } else {
            $error_message = 'Invalid eleve data. Check all fields and resubmit.';
            include('C:\Users\Panda\Desktop\Projet_Final_PHP\view\errors\404.phtml');
        }
        break;
        //La fonction est appelée pour supprimer l'élève de la base de données
        //L'utilisateur est alors redrigé vers une page lui informant que la suppression est un succès

    default:
        include('C:\Users\Panda\Desktop\Projet_Final_PHP\view\eleves\add.phtml');
        //Par défaut, la page de recherche et de création est affichée
}
