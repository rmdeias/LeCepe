<?php
session_start();
use Controllers\Manager\ConnectDb;
use PDO;
require_once 'Manager/ConnectDb.php';

 $dbh = new ConnectDb();

$_POST["Email"] = htmlspecialchars($_POST["Email"]);
$_POST["Password"] = htmlspecialchars($_POST["Password"]);
$passRegex = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/';

$query = $dbh->prep("SELECT id, Email, adminPassword FROM connectadmin WHERE id = id");
$query->execute();
$admin = $query->fetch(PDO::FETCH_ASSOC);

if (isset($admin["Email"]) && isset($admin["adminPassword"])) {
    $_SESSION["admin"] = [
        "id" => $admin["id"],
        "Email" => $admin["Email"],
        "Password" => $admin["adminPassword"],
    ];

    if ($admin["Email"] === $_POST["Email"] && password_verify($_POST["Password"], $admin["adminPassword"])) {
        header('Location: ProductGestion.php');
        exit;
    } else {
        die("Informations incorrectes");
    }
} else {
    if (preg_match($passRegex, $_POST["Password"]) && filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
        $query = $dbh->prep("INSERT INTO connectadmin (Email, adminPassword) Values (:Email, :Password)");
        $query->execute(
            [
                "Email" => $_POST["Email"],
                "Password" => password_hash($_POST["Password"], PASSWORD_DEFAULT),
            ]
        );
        header('Location: ./Connection.php');
        exit;
    } else {
        die("Adresse mail non valide ou votre Mot de passe ne contient pas 8 caractères avec au moins un chiffre , une majuscule et un caractère spécial");
    }
}