<?php
session_start();
require_once '../Controllers/Manager/BandManager.php';
require_once '../Controllers/Manager/ReadDeleteManager.php';
require_once '../Controllers/Entity/Band.php';
require_once '../Controllers/Manager/DevFunctions.php';

use Controllers\Manager\BandManager;
use Controllers\Manager\ReadDeleteManager;
use Controllers\Entity\Band;
use Controllers\Manager\DevFunctions;

$_POST["iframeYoutube"] = htmlspecialchars($_POST["iframeYoutube"]);
$_POST["iframeBandcamp"] = htmlspecialchars($_POST["iframeBandcamp"]);
$entity = new Band();
$devFunction = new DevFunctions();

$entity->setName($_POST["name"]);
$entity->setImage("le-cepe-records-".$_FILES["imageBand"]["name"]);
$entity->setDescription($_POST["description"]);
$entity->setLinkFB($_POST["linkFB"]);
$entity->setLinkInsta($_POST["linkInsta"]);
$entity->setLinkYoutube($_POST["linkYoutube"]);
$entity->setIframeBandcamp($_POST["iframeBandcamp"]);
$entity->setIframeYoutube($_POST["iframeYoutube"]);

// Correction des caracteres spécifique 
$devFunction->slugify($_POST["name"], $entity);

$path = "../../assets/images/bands/". $entity->getSlug()."/";

// Modification 
if(isset($_POST["id"])){
    
    // Récupére les datas du Band
    $checkForUpdate = new ReadDeleteManager('bands');
    $check = $checkForUpdate->readById("name,bandSlug,imageBand",$_POST["id"]);

    $updateInfo = new BandManager('bands');
    $entity->setId($_POST["id"]);

    if($check["name"] != $_POST["name"]){
        //copie dossier
        $devFunction->copyDirectory(
            "../../assets/images/bands/".$check["bandSlug"],
            "../../assets/images/bands/". $entity->getSlug()
        ); 
    
        //suprimme l'ancien dossier
        $devFunction->deleteDirectory("../../assets/images/bands/".$check["bandSlug"]);
    }
    
    if( $_FILES["imageBand"]["name"] !== ""){ 
        
        //suprimme l'ancienne image dans le nouveau dossier
        if( $check["imageBand"] !== ""){ 
        
            $devFunction->deleteDirectory("../../assets/images/bands/".$entity->getSlug()."/".$check["imageBand"]);
        }
    
        $devFunction->uploadPhoto($path,"le-cepe-records-","imageBand",759,500);
        $updateInfo->update($entity); 
    }
    // Si aucune saisie pour photo
    else{ 
        $updateInfo->updateNoPhoto($entity);
    }
    
} 
// Creation d'une nouvelle ligne 
else{
    
    $devFunction->uploadPhoto($path,"le-cepe-records-","imageBand",759,500);
    $insertInfo = new BandManager('bands');
    $insertInfo->create($entity);
}

header('Location: ../Controllers/BandGestion.php');
exit;

?>  