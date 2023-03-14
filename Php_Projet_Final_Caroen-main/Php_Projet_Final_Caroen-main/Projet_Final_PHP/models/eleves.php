<?php

interface eleveModelInterface
{
    function insert_eleve($neweleve, $nom, $age, $newemail);
    function select_eleve_by_name($eleve);
    function update_eleve($id, $eleve, $nom, $age, $email);
    function delete_eleve($id);
}

function insert_eleve($neweleve, $nom, $age, $newemail)
{
    global $db;
    //Utilisation de "global" pour accéder à la variable $db, qui est une connexion à une base de donée
    $count = 0;
    //On initialise la variable $count à 0
    $query = "INSERT INTO eleve
 
                        (prenom,nom,age,email) 
                    VALUES 
                        (:neweleve, :nom, :age, :newemail)";
    //La variable $query contient une chaîne de caractère définissant une instruction pour ajouter un nouvel élève
    //On utilise les valeurs (:neweleve, :nom, :age, :newemail) pour remplir les colonnes (prenom,nom,age,email)

    $statement = $db->prepare($query);
    //Préparation de la requète à éxécutée, on remplace les parties variables par des paramètres

    $statement->bindValue(':neweleve', $neweleve);
    $statement->bindValue(':nom', $nom);
    $statement->bindValue(':age', $age);
    $statement->bindValue(':newemail', $newemail);
    //On définis les paramètres avec "bindValue"

    if ($statement->execute()) {
        $count = $statement->rowCount();
    };
    //La variable $count est mise à jour avec le nombre de lignes affectées par la requête (dans notre cas, il n'y en a qu'une)

    return $count;
    //On renvoie la valeur de $count
}
//

function select_eleve_by_name($eleve)
{
    global $db;
    $query = 'SELECT * FROM eleve
 
                WHERE prenom = :eleve
             
                ORDER BY email DESC';
    //Uitlisation d'une requête SQL pour sélectionner toutes les colonnes de la table eleve où le prénom est égal à la valeur de $eleve
    $statement = $db->prepare($query);
    //Préparation de la requète à éxécutée, on remplace les parties variables par des paramètres
    $statement->bindValue(':eleve', $eleve);
    $statement->execute();
    //Execution de la requête
    $results = $statement->fetchAll();
    //Récupération du résultat de la requête en utilisant la méthode "fetchAll"
    return $results;
}

function update_eleve($id, $eleve, $nom, $age, $email)
{
    global $db;
    $count = 0;
    //On initialise $count à 0
    $query = 'UPDATE eleve
 
                SET prenom = :eleve
            , nom = :nom, age = :age, 
                    email = :email WHERE ID = :id';
    //On utilise une requeête SQL pour mettre à jour l'enregistrement de l'eleve en utilisant les paramètres fournis
    $statement = $db->prepare($query);
    //Préparation de la requète à éxécutée, on remplace les parties variables par des paramètres
    $statement->bindValue(':id', $id);
    $statement->bindValue(':eleve', $eleve);
    $statement->bindValue(':nom', $nom);
    $statement->bindValue(':age', $age);
    $statement->bindValue(':email', $email);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    };
    //On exécute ensuite la requête en appelant la méthode "execute" de l'objet $statement
    //La fonction récupère le nombre de ligne puis le stocke dans sa variable $count
    return $count;
    //On retounre la valeur de $count
}

function delete_eleve($id)
{
    global $db;
    $count = 0;
    $query = 'DELETE FROM eleve
 
                WHERE ID = :id';
    //Utilisation d'une requête SQL pour supprimer les données relative à un eleve définis par son id
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    if ($statement->execute()) {
        $count = $statement->rowCount();
    };
    return $count;
}
