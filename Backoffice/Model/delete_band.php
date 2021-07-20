<?php
session_start();
require_once '../Controllers/Manager/ReadDeleteManager.php';
require "./upload_functions.php";
use Controllers\Manager\ReadDeleteManager;


//Delete en dossier  
$checkForDelete = new ReadDeleteManager('bands');
$check = $checkForDelete->readById("slug",$_GET["id"]);
deleteDirectory("../../assets/images/bands/".$check["slug"]);


//Delete en database
$deleteData = new ReadDeleteManager('bands');
$info = $deleteData->deleteById();

header('Location: ../Controllers/BandGestion.php');
exit();


?>