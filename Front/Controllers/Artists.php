<?php
use Controllers\Manager\BandManager;
require_once 'Backoffice/Controllers/Manager/BandManager.php';
     
    $title = "Artists";

    $readAllInfo = new BandManager('bands');
    $bands = $readAllInfo->readAll();
    
    if(isset($_GET["id"])) { 
        
        $readInfoForUpdate = new BandManager('bands');
        $info = $readInfoForUpdate->readById('*',$_GET["id"]);
    }
    
require "./Front/Views/Artists.phtml";
require "./Front/Views/Layout.phtml";

