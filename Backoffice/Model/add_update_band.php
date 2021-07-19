<?php
session_start();
require_once '../Controllers/Manager/BandManager.php';
require_once '../Controllers/Entity/Band.php';
require "./upload_functions.php";
use Controllers\Manager\BandManager;
use Controllers\Entity\Band;
$_POST["iframeYoutube"] = htmlspecialchars($_POST["iframeYoutube"]);
$entity = new Band();

$entity->setName($_POST["name"]);
$entity->setImage("le-cepe-records-".$_FILES["imageBand"]["name"]);
$entity->setDescription($_POST["description"]);
$entity->setLinkFB($_POST["linkFB"]);
$entity->setLinkInsta($_POST["linkInsta"]);
$entity->setLinkYoutube($_POST["linkYoutube"]);
$entity->setLinkBandcamp($_POST["linkBandcamp"]);
$entity->setIframeYoutube($_POST["iframeYoutube"]);

if(strpos($_POST["name"] , "&" )){

    $entity->setSlug(str_replace("&", "and", $_POST["name"]));
    $entity->setSlug(str_replace(" ", "-", $entity->getSlug()));
}
else{
    $entity->setSlug(str_replace(" ", "-", $_POST["name"]));
}
    
$path = "../../assets/images/bands/". $entity->getSlug()."/";


// Modification 
if(isset($_POST["id"])) {
    
    // Récupére les datas du Band
    $checkForUpdate = new BandManager('bands');
    $check = $checkForUpdate->readById("name,slug,imageBand",$_POST["id"]);

    $updateInfo = new BandManager('bands');
    $entity->setId($_POST["id"]);


    if($check["name"] != $_POST["name"]){
        //copie dossier
        copyDirectory(
            "../../assets/images/bands/".$check["slug"],
            "../../assets/images/bands/". $entity->getSlug()
        ); 
    
        //suprimme l'ancien dossier
        deleteDirectory("../../assets/images/bands/".$check["slug"]);
    }
       
    if( $_FILES["imageBand"]["name"] !== ""){ 
        
        //suprimme l'ancienne image dans le nouveau dossier
        if( $check["imageBand"] !== ""){ 
           
            deleteDirectory("../../assets/images/bands/".$entity->getSlug()."/".$check["imageBand"]);
        }
    
        uploadPhoto($path);
        $updateInfo->update($entity); 
    }
    // Si aucune saisie pour photo
    else{ 
        $updateInfo->updateNoPhoto($entity);
    }
    
    
} 
// Creation d'une nouvelle ligne 
else{
    
    // recherche "/" dans le nom pour éviter la création d'un sous dossier ou d'une balise fermante html
    if (strpos(htmlspecialchars($_POST["name"]),"/") == false){
        
        uploadPhoto($path);
        $insertInfo = new BandManager('bands');
        $insertInfo->create($entity);
    }
    else{
        die("Le nom de doit pas contenir /");
    }
}

header('Location: ../Controllers/BandGestion.php');
exit;

?>  