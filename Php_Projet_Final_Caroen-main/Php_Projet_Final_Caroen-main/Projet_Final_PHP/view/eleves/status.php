<?php
$created = filter_input(INPUT_GET, "created", FILTER_VALIDATE_INT);
$updated = filter_input(INPUT_GET, "updated", FILTER_VALIDATE_INT);
$deleted = filter_input(INPUT_GET, "deleted", FILTER_VALIDATE_INT);
//On utilise la fonction filter_input() pour récupérer les valeurs de trois paramètres
//FILTER_VALIDATE_INT indique que nous validons la valeur récupérée en tant qu'entier.

if ($created) {
    echo "Les données concernant le nouvel élève ont étais créées !";
}

if ($updated) {
    echo "Les données concernant l'élève ont étaient mis à jours !";
}


if ($deleted) {
    echo "Les données concernant l'élève ont étaient supprimées !";
}

//On vérifie si les variables sont définies et ont une valeur (autre que zéro), dans ce cas l'utilisateur observeras un message montrant le succès de son action
