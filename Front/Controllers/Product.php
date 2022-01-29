<?php

use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';

if(isset($_GET["le_cepe_records_merch"])) { 
   
    $id = explode("-",$_GET["le_cepe_records_merch"]);
    
    $products = new ReadDeleteManager('products');
    $product = $products->readInnerJoinWhereProductId('products.*,name,bandSlug',$id[1]);
     
    $moreProductsFromThisArtist = new ReadDeleteManager('products');
    $moreProducts = $moreProductsFromThisArtist -> readInnerJoinAllReleases('products.*,name,bandSlug','WHERE products.id != '.$id[1].' AND products.id_band ='.$id[0]);

    $title = $product["name"]." ".$product["title"];
    require "./Front/Views/Product.phtml";
    require "./Front/Views/Layout.phtml";  
}     
      
