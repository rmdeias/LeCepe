<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';

    if(isset($_GET["name"])) { 

        
        $id = explode("-",$_GET["name"]);
     
      
        $readInfoBand = new ReadDeleteManager('bands');
        $info = $readInfoBand->readById('*',$id[0]);
         
        
        $moreProducts = new ReadDeleteManager('products');
        $products = $moreProducts->readInnerJoinWhereBandId('products.*,name,bandSlug',$id[0]);
        
       
      
        $title = $info["name"];
        require "./Front/Views/Band.phtml";
        require "./Front/Views/Layout.phtml";
    }
    
   
