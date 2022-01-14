<?php
session_start();
require_once '../Controllers/Manager/ReadDeleteManager.php';
require_once '../Controllers/Manager/DevFunctions.php';

use Controllers\Manager\ReadDeleteManager;
use Controllers\Manager\DevFunctions;

$devFunction = new DevFunctions();

// Récupére le id_band du produit
$readInfoForIdBand = new ReadDeleteManager('products');
$idBand = $readInfoForIdBand->readById('id_band',$_GET["id"]);

// Récupére les datas du produit
$checkForDelete = new ReadDeleteManager('products');
$check = $checkForDelete->readInnerJoinWhereProductId("slug,bands.bandSlug",$_GET["id"]);
$devFunction->deleteDirectory("../../assets/images/bands/".$check["bandSlug"]."/".$check["slug"]);

//Delete en database
$deleteData = new ReadDeleteManager('products');
$info = $deleteData->deleteById($_GET["id"]);

header('Location: ../Controllers/ProductGestion.php');
exit();


?>