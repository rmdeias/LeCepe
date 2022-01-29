<?php
session_start();
require_once '../Controllers/Manager/ProductManager.php';
require_once '../Controllers/Manager/ReadDeleteManager.php';
require_once '../Controllers/Entity/Product.php';
require_once '../Controllers/Manager/DevFunctions.php';

use Controllers\Manager\ProductManager;
use Controllers\Manager\ReadDeleteManager;
use Controllers\Entity\Product;
use Controllers\Manager\DevFunctions;


$_POST["iframeBandcamp"] = htmlspecialchars($_POST["iframeBandcamp"]);
$entity = new Product();
$devFunction = new DevFunctions();

$entity->setImage("le-cepe-records-".$_FILES["image"]["name"]);

//si pas d'image Alt
if ($_FILES["imageAlt"]["name"] == ""){
    $entity->setImageAlt("le-cepe-records-".$_FILES["image"]["name"]);
}
else{
    $entity->setImageAlt("le-cepe-records-alt-".$_FILES["imageAlt"]["name"]);
}

$entity->setTitle($_POST["title"]);
$entity->setDate($_POST["dateSortie"]);
$entity->setType($_POST["type"]);
$entity->setPrice($_POST["price"]);
$entity->setDispo($_POST["dispo"]);
$entity->setDescription($_POST["description"]);
$entity->setIframeBandcamp($_POST["iframeBandcamp"]);
$entity->setLinkBandcamp($_POST["linkBandcamp"]);
     
// Correction des caracteres spécifique
$devFunction->slugify($_POST["title"], $entity);

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
        //copie dossier avec le nouveau path
        $devFunction->copyDirectory(
            "../../assets/images/bands/".$oldCheck["bandSlug"]."/".$check["slug"],
            "../../assets/images/bands/".$check["bandSlug"]."/". $entity->getSlug()
        ); 
    
        //suprimme l'ancien dossier
        $devFunction->deleteDirectory("../../assets/images/bands/".$oldCheck["bandSlug"]."/".$check["slug"]);
    }

    if( $_FILES["image"]["name"] !== ""){ 
        
        //suprimme l'ancienne image dans le nouveau dossier
        if( $check["image"] !== "" && $check["image"] !== $check["imageAlt"] ){ 
        
            $devFunction->deleteDirectory("../../assets/images/bands/".$oldCheck["bandSlug"]."/".$entity->getSlug()."/".$check["image"]);
        }
        
        $devFunction->uploadPhoto($path,"le-cepe-records-","image",900,900);
        $updateInfo->updateImage($entity);
    }

    elseif($_FILES["imageAlt"]["name"] !== "" ){

        //suprimme l'ancienne imageAlt dans le nouveau dossier
        if( $check["imageAlt"] !== "" || $check["imageAlt"] !== $check["image"]){ 
        
            $devFunction->deleteDirectory("../../assets/images/bands/".$oldCheck["bandSlug"]."/".$entity->getSlug()."/".$check["imageAlt"]);
        }
        $devFunction->uploadPhoto($path,"le-cepe-records-alt-","imageAlt",900,900);
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
    
    $devFunction->uploadPhoto($path,"le-cepe-records-","image",900,900);
 
    //si pas d'image Alt
    if ($_FILES["imageAlt"]["name"] !== ""){
        $devFunction->uploadPhoto($path,"le-cepe-records-alt-","imageAlt",900,900); 
    } 
    
}
 
// go to previous page
$redirect_url = (isset($_SESSION['redirect_url'])) ? $_SESSION['redirect_url'] : '/';
unset($_SESSION['redirect_url']);
header("Location: $redirect_url", true, 303);
exit;

?>  