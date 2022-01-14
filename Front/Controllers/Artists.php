<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';
     
    $title = "Le Cépe Records - Artists";

    $readAllInfo = new ReadDeleteManager('bands');
    $bands = $readAllInfo->read('*',"WHERE name != 'Le Cepe Records Merch'");
    
    if(isset($_GET["id"])) { 
        
        $readInfoForUpdate = new ReadDeleteManager('bands');
        $info = $readInfoForUpdate->readById('*',$_GET["id"]);
    }
    
require "./Front/Views/Artists.phtml";
require "./Front/Views/Layout.phtml";

