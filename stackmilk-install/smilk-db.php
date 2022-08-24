<?php

$dbhost = $_POST['dbhost'];
$dbuser = $_POST['dbuser'];
$dbpass = $_POST['dbpass'];

// Create connection
try {

    // Test connection
    $conn = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);

    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // If connection is successful
    echo "Connected successfully<br>";
    setup_database($conn);

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

function setup_database($conn){
    global $dbhost;
    global $dbuser;
    global $dbpass;

    // First, check if Stackmilk database exists; if not, create it
    $sql = "CREATE DATABASE IF NOT EXISTS stackmilk";
    $conn->exec($sql);

    // Then, reset connection to connect to Stackmilk Databse
    $conn = null;

    // Connect to Stackmilk database
    $conn = new PDO("mysql:host=$dbhost;dbname=stackmilk", $dbuser, $dbpass);

    // Create Stackmilk tables
    $sql = "CREATE TABLE IF NOT EXISTS settings (
        setting_id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        setting_name VARCHAR(100),
        setting_value VARCHAR(255)
    )";
    $conn->exec($sql);
}
