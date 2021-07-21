<?php
session_start();

require_once 'Manager/ReadDeleteManager.php';
use Controllers\Manager\ReadDeleteManager;

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION["admin"])) {
     
    $title = "Gestion des Groupes";

    $readAllInfo = new ReadDeleteManager('bands');
    $infos = $readAllInfo->read('*');
 
    require "../views/BandGestion.phtml";
    require "../views/Layout.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}
?> 