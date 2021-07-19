<?php
session_start();

require_once 'Manager/BandManager.php';
use Controllers\Manager\BandManager;

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION["admin"])) {
     
    $title = "Gestion des Groupes";

    $readAllInfo = new BandManager('bands');
    $infos = $readAllInfo->readAll();

    require "../views/BandGestion.phtml";
    require "../views/Layout.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}
?> 