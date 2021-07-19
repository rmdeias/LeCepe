<?php
session_start();

require_once 'Manager/ProductManager.php';
use Controllers\Manager\ProductManager;

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION["admin"])) {
     
    $title = "Gestion des Produits";

    $readAllInfo = new ProductManager('products');
    $infos = $readAllInfo->readAll();

    require "../views/ProductGestion.phtml";
    require "../views/Layout.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}
?> 