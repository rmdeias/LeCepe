<?php
session_start();
use Controllers\Manager\ReadDeleteManager;
require_once 'Manager/ReadDeleteManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION["admin"])) {
     
    $title = "Gestion des Produits";

    $readAllInfo = new ReadDeleteManager('products');
    $infos = $readAllInfo->readInnerJoin('products.*,bands.name,bands.bandSlug');
  
    require "../views/ProductGestion.phtml";
    require "../views/Layout.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}
?> 