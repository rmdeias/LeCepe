<?php
session_start();
use Controllers\Manager\ReadDeleteManager;
require_once 'Manager/ReadDeleteManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION['admin'])) {
    
    $read = new ReadDeleteManager('bands');
    $listeBands = $read->read('id,name');
    
    
    
    if(isset($_GET["id"])) { 
        
        $title = "Update Product";
        
        $readInfoForUpdate = new ReadDeleteManager('products');
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