<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';

    if(isset($_GET["name"])) { 

        $id = explode("-",$_GET["name"]);
     
        $readInfo = new ReadDeleteManager('bands');
        $info = $readInfo->readById('*',$id[1]);
        $title = $info["name"];

        require "./Front/Views/Band.phtml";
        require "./Front/Views/Layout.phtml";
    }
    else{
        
    }

