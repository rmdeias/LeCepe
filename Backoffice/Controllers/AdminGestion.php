<?php
session_start();

require_once 'Manager/AcessManager.php';
use Controllers\Manager\AcessManager;

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION["admin"])) {
     
    $title = "Admin Gestion";

   // $readAllInfo = new AcessManager('');
   // $infos = $readAllInfo->readAll();

    include "../views/AdminGestion.phtml";
}
else{
    http_response_code(404);
    header('Location: ../index.php');
    exit;
}
?> 