<?php
session_start();
use Controllers\Manager\AcessManager;
require_once 'Manager/AcessManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION['admin'])) {
    
    if(isset($_GET["id"])) { 
        
        $title = "Update Data";
        
        $readInfoForUpdate = new AcessManager('db_info');
        $info = $readInfoForUpdate->readById('*',$_GET["id"]);
    }
    else{
        $title = "Add Data";  
    }

    include "../views/FormAddUpdate.phtml";
}
else{
    http_response_code(404);
    header('Location: Home.php');
    exit;
}

?>