<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';

    if(isset($_GET["name"])) { 

        
        $id = explode("-",$_GET["name"]);
     
        $readInfoBand = new ReadDeleteManager('bands');
        $info = $readInfoBand->readById('*',$id[1]);
        

        $moreProducts = new ReadDeleteManager('products');
        $products = $moreProducts->readInnerJoinId('products.*,bands.name,bands.bandSlug',$id[1]);
        var_dump($products);
    
      
        $title = $info["name"];
        require "./Front/Views/Band.phtml";
        require "./Front/Views/Layout.phtml";
    }
    else{
        
    }

