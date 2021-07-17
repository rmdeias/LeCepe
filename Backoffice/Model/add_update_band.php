<?php
session_start();
require_once '../Controllers/Manager/BandManager.php';
require_once '../Controllers/Entity/Band.php';
use Controllers\Manager\BandManager;
use Controllers\Entity\Band;


$entity = new Band();

$entity->setName($_POST["name"]);
$entity->setImage($_POST["imageBand"]);
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
    
//$entity->setIdBand($_POST["price"]);

// Modification 
if(isset($_POST["id"])) {
    
    $updateInfo = new BandManager('bands');
    $entity->setId($_POST["id"]);
    $updateInfo->update($entity);    
} 
// Creation d'une nouvelle ligne 
else{
   
    $insertInfo = new BandManager('bands');
    $insertInfo->create($entity);
}

header('Location: ../Controllers/BandGestion.php');
exit;

?>  