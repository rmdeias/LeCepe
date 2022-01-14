<?php
session_start();
use Controllers\Manager\ReadDeleteManager;
require_once 'Manager/ReadDeleteManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION["admin"])) {
    $_SESSION['redirect_url'] = $_SERVER['PHP_SELF']; // redirection apres validation formulaire
    $chooseProductsToDisplay = "Merch";
    $title = "Gestion Merchandising";

    $readAllInfo = new ReadDeleteManager('products');
    $infos = $readAllInfo->readInnerJoinAllReleases('products.*,bands.name,bands.bandSlug',"WHERE bands.name ='Le Cepe Records Merch'");
  
    require "../views/ProductGestion.phtml";
    require "../views/Layout.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}
?> 