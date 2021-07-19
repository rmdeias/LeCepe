<?php
session_start();
use Controllers\Manager\ProductManager;
require_once 'Manager/ProductManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION['admin'])) {
    
    if(isset($_GET["id"])) { 
        
        $title = "Update Product";
        
        $readInfoForUpdate = new ProductManager('products');
        $info = $readInfoForUpdate->readById('*',$_GET["id"]);
    }
    else{
        $title = "Add Product";  
    }

    require "../views/FormAddUpdateProducts.phtml";
    require "../views/Layout.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}

?>