<?php
session_start();
require_once '../Controllers/Manager/ReadDeleteManager.php';
require_once '../Controllers/Manager/DevFunctions.php';

use Controllers\Manager\ReadDeleteManager;
use Controllers\Manager\DevFunctions;

$devFunction = new DevFunctions();
//Delete le dossier du groupe 
$checkForDelete = new ReadDeleteManager('bands');
$check = $checkForDelete->readById("bandSlug",$_GET["id"]);
$devFunction->deleteDirectory("../../assets/images/bands/".$check["bandSlug"]);

// Récupére les ids  des produit
$checkForDeleteProducts = new ReadDeleteManager('products');
$checkIds = $checkForDeleteProducts->readInnerJoinWhereBandId("products.id",$_GET["id"]);


$deleteData = new ReadDeleteManager('products');
foreach($checkIds as $check ){
    $deleteData->deleteById($check["id"]);
}

//Delete en le groupe database
$deleteData = new ReadDeleteManager('bands');
$deleteData->deleteById($_GET["id"]);

header('Location: ../Controllers/BandGestion.php');
exit();


?>