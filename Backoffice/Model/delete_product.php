<?php
session_start();
require_once '../Controllers/Manager/ReadDeleteManager.php';
require "./upload_functions.php";
use Controllers\Manager\ReadDeleteManager;

// Récupére le id_band du produit
$readInfoForIdBand = new ReadDeleteManager('products');
$idBand = $readInfoForIdBand->readById('id_band',$_GET["id"]);

// Récupére les datas du produit
$checkForDelete = new ReadDeleteManager('products');
$check = $checkForDelete->readInnerJoinWhereId("slug,bands.bandSlug",$idBand["id_band"],$_GET["id"]);
deleteDirectory("../../assets/images/bands/".$check["bandSlug"]."/".$check["slug"]);

//Delete en database
$deleteData = new ReadDeleteManager('products');
$info = $deleteData->deleteById();

header('Location: ../Controllers/ProductGestion.php');
exit();


?>