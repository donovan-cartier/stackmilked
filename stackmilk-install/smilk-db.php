<?php

$dbhost = $_POST['dbhost'];
$dbuser = $_POST['dbuser'];
$dbpass = $_POST['dbpass'];

// Create connection
try {
    $conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>";
    $sql = "CREATE DATABASE stackmilk";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Database created successfully<br>";
  } catch(PDOException $e) {
    print_r($e->errorInfo);
    $error_code = $e->errorInfo[1];
    print return_error($error_code);
}

// handling errors
function return_error($error_code){
    switch ($error_code) {
        case '2002':
            return "Désolé, l'hôte entrée est inconnue.";
            break;
        case '1045':
            return "Accès refusé.";
            break;

        default:
            return "Erreur inattendue.";
            break;
    }
}
