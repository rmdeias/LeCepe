<?php

use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';

if(isset($_GET["le_cepe_records_merch"])) { 
   
    $id = explode("-",$_GET["le_cepe_records_merch"]);
    
    $moreProducts = new ReadDeleteManager('products');
    $product = $moreProducts->readInnerJoinWhereProductId('products.*,name,bandSlug',$id[1]);
   
    $title = $product["name"]." ".$product["title"];
    require "./Front/Views/Product.phtml";
    require "./Front/Views/Layout.phtml";  
}     
      
