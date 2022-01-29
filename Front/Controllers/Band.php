<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';

    if(isset($_GET["le_cepe_records_artist"])) { 
 
        $id = explode("-",$_GET["le_cepe_records_artist"]);
     
        // band info 
        $readInfoBand = new ReadDeleteManager('bands');
        $leCepeRecordsArtist = $readInfoBand->readById('*',$id[0]);
         
        // products from band
        $moreProducts = new ReadDeleteManager('products');
        $leCepeRecordsArtistProducts = $moreProducts->readInnerJoinWhereBandId('products.*,name,bandSlug',$id[0]);
      
        $title ="Le Cépe Records - ". $leCepeRecordsArtist["name"];
        require "./Front/Views/Band.phtml";
        require "./Front/Views/Layout.phtml";
    }
    
   
