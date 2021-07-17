<?php
session_start();
use Controllers\Manager\BandManager;
require_once 'Manager/BandManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION['admin'])) {
    
    if(isset($_GET["id"])) { 
        
        $title = "Update Band";
        
        $readInfoForUpdate = new BandManager('bands');
        $info = $readInfoForUpdate->readById('*',$_GET["id"]);
    }
    else{
        $title = "Add Band";  
    }

    include "../views/FormAddUpdateBands.phtml";
}
else{
    http_response_code(404);
    header('Location: ../../index.php');
    exit;
}

?>