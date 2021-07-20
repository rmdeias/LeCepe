<?php
session_start();
require_once '../Controllers/Manager/ProductManager.php';
require_once '../Controllers/Manager/ReadDeleteManager';
require_once '../Controllers/Entity/Product.php';
use Controllers\Manager\ProductManager;
use Controllers\Manager\ReadDeleteManager;
use Controllers\Entity\Product;


$entity = new Product();

$entity->setImage("le-cepe-records-".$_FILES["image"]["name"]);
$entity->setImageAlt("le-cepe-records-alt-".$_FILES["imageAlt"]["name"]);
$entity->setTitle($_POST["title"]);
$entity->setDate($_POST["dateSortie"]);
$entity->setType($_POST["type"]);
$entity->setPrice($_POST["price"]);
$entity->setDispo($_POST["dispo"]);
$entity->setDescription($_POST["description"]);
$entity->setLinkProduct($_POST["linkBandcamp"]);

if(strpos($_POST["title"] , "&" )){

    $entity->setSlug(str_replace("&", "and", $_POST["title"]));
    $entity->setSlug(str_replace(" ", "-", $entity->getSlug()));
}
else{
    $entity->setSlug(str_replace(" ", "-", $_POST["title"]));
}
    
$entity->setIdBand($_POST["bands"]);



// Modification 
if(isset($_POST["id"])) {
    
    $updateInfo = new ProductManager('products');
    $entity->setId($_POST["id"]);
    $updateInfo->update($entity);    
} 
// Creation d'une nouvelle ligne 
else{
   
    $insertInfo = new ProductManager('products');
    $insertInfo->create($entity);
}

header('Location: ../Controllers/ProductGestion.php');
exit;

?>  