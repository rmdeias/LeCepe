<?php
session_start();
use Controllers\Manager\ReadDeleteManager;
require_once 'Manager/ReadDeleteManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION['admin'])) {
    
    if(isset($_GET["id"])) { 
        
        $title = "Update Band";
        
        $readInfoForUpdate = new ReadDeleteManager('bands');
        $info = $readInfoForUpdate->readById('*',$_GET["id"]);
    }
    else{
        $title = "Add Band";  
    }

    require "../views/FormAddUpdateBands.phtml";
    require "../views/Layout.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}

?>