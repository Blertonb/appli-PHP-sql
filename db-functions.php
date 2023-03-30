<?php

function connexion(){ 
    $user= "root"; 
    $pass="";
    $options= [ \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, // précise le type d'erreur que PDO renverra en cas de requête invalide
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // mode de récupération des données de la base par défaut
    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // cette commande force la prise en charge de l'UTF-8 lorsqu'on entrera des données en base
];

     $pdo = new PDO('mysql:host=localhost;dbname=store', $user, $pass,$options); return $pdo;

     return $pdo;
}

 function findAll(){
    $dbh = connexion();// on a utiliser la fonction Connexion demander dans l'exo, pour pourvoir integrer les 3 bases de donneés.
    $sth = $dbh->prepare("SELECT * FROM product");//on utilise les bases de données afin,plus précissément les requetes afin d'excetuer la fonction.
$sth->execute();
$result = $sth->fetchAll();//la fonction fetchAll, nous permet d'obtenir le resultat.
return $result;
}

function findOneById($id){ 
    $dbh = connexion(); $sth= $dbh->prepare("select id, name,description,price from product Where id =:id"); $sth->execute(["id" => $id]); return $sth->fetch(); }


function insertProduct($name, $descr, $price) {
    $dbh = connexion();
    $insert= $dbh->prepare("INSERT INTO product (name, description, price) VALUES(:name,:descr,:price)"); //: = clé 
    $insert->execute([
        "name" => $name, // clé name prend la valeur de $name 
        "description" => $descr,
        "price" => $price
    ]);  
    
    return $dbh->lastInsertId(); //Methode statique qui permett de récupérer le dernier identifiant inséré
    }

?>
