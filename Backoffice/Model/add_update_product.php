<?php
session_start();
require_once '../Controllers/Manager/ProductManager.php';
require_once '../Controllers/Manager/ReadDeleteManager.php';
require_once '../Controllers/Entity/Product.php';
require "./upload_functions.php";
use Controllers\Manager\ProductManager;
use Controllers\Manager\ReadDeleteManager;
use Controllers\Entity\Product;


    $_POST["iframeBandcamp"] = htmlspecialchars($_POST["iframeBandcamp"]);
    $entity = new Product();

    $entity->setImage("le-cepe-records-".$_FILES["image"]["name"]);
    $entity->setImageAlt("le-cepe-records-".$_FILES["imageAlt"]["name"]);
    $entity->setTitle($_POST["title"]);
    $entity->setDate($_POST["dateSortie"]);
    $entity->setType($_POST["type"]);
    $entity->setPrice($_POST["price"]);
    $entity->setDispo($_POST["dispo"]);
    $entity->setDescription($_POST["description"]);
    $entity->setIframeBandcamp($_POST["iframeBandcamp"]);
    $entity->setLinkBandcamp($_POST["linkBandcamp"]);
    

    if(strpos($_POST["title"] , "&" )|| strpos($_POST["title"] , "/" )){

        $entity->setSlug(strtolower(str_replace(["&","/"], "and", $_POST["title"])));
        $entity->setSlug(str_replace(" ", "-", $entity->getSlug()));
    }
    else{
        $entity->setSlug(strtolower(str_replace(" ", "-", $_POST["title"])));
    }
        
    $entity->setIdBand($_POST["bands"]);
    
    // Modification 
    if(isset($_POST["id"])) {
         //Récupére les datas du produit 
        $checkForUpdate = new ReadDeleteManager('products');
        $check = $checkForUpdate->readInnerJoinWhereProductId("products.*,bands.bandSlug,bands.id",$_POST["id"]);
        $oldCheck = $check; 

        //Récupere les data de bands
        $checkBand = new ReadDeleteManager('bands');
        $checkband = $checkBand->readById("id,bandSlug",$_POST["bands"]);


        $updateInfo = new ProductManager('products');
        $entity->setId($_POST["id"]);
        
        if($checkband["id"] !== $check["id_band"] ){
            $check["bandSlug"] = $checkband["bandSlug"];
        }

        $path= "../../assets/images/bands/".$check["bandSlug"]."/". $entity->getSlug()."/";
        
        if($check["title"] != $_POST["title"] && $check["bandSlug"] == $checkband["bandSlug"]){
            //copie dossier
            copyDirectory(
                "../../assets/images/bands/".$oldCheck["bandSlug"]."/".$check["slug"],
                "../../assets/images/bands/".$check["bandSlug"]."/". $entity->getSlug()
            ); 
        
            //suprimme l'ancien dossier
            deleteDirectory("../../assets/images/bands/".$oldCheck["bandSlug"]."/".$check["slug"]);
        }

        if( $_FILES["image"]["name"] !== ""){ 
            
            //suprimme l'ancienne image dans le nouveau dossier
            if( $check["image"] !== ""){ 
            
               deleteDirectory("../../assets/images/bands/".$oldCheck["bandSlug"]."/".$entity->getSlug()."/".$check["image"]);
            }
            
            uploadPhoto($path,"image",500,500);
            $updateInfo->updateImage($entity);
        }

        elseif($_FILES["imageAlt"]["name"] !== ""){

            //suprimme l'ancienne imageAlt dans le nouveau dossier
            if( $check["imageAlt"] !== ""){ 
            
                deleteDirectory("../../assets/images/bands/".$oldCheck["bandSlug"]."/".$entity->getSlug()."/".$check["imageAlt"]);
            }
            uploadPhoto($path,"imageAlt",500,500);
            var_dump("ALT ".$path);
            $updateInfo->updateImageAlt($entity);
        }
        
        // Si aucune saisie pour photo
        else{ 
      
            $updateInfo->updateNoPhoto($entity);
        }
   
    } 
    // Creation d'une nouvelle ligne 
    else{
       
        $insertInfo = new ProductManager('products');
        $insertInfo->create($entity);
        
        // Recherche le slug de band correspondant a id_band du produit
      
        $readBandSlug = new ReadDeleteManager('bands');
        $bandSlug = $readBandSlug->readById('bands.bandSlug,bands.id',$entity->getIdBand() );      
        $path ="../../assets/images/bands/".$bandSlug["bandSlug"]."/".$entity->getSlug()."/";
       
        uploadPhoto($path,"image",500,500);
        uploadPhoto($path,"imageAlt",500,500); 
    }

header('Location: ../Controllers/ProductGestion.php');
exit;

?>  