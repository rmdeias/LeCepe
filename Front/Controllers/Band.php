<?php
use Controllers\Manager\BandManager;
require_once 'Backoffice/Controllers/Manager/BandManager.php';

    if(isset($_GET["name"])) { 

        $id = explode("-",$_GET["name"]);
     
        $readInfo = new BandManager('bands');
        $info = $readInfo->readById('*',$id[1]);
        $title = $info["name"];

        require "./Front/Views/Band.phtml";
        require "./Front/Views/Layout.phtml";
    }
    else{
        
    }

