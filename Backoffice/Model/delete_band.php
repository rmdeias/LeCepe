<?php
session_start();
require "./upload_functions.php";
require_once '../Controllers/Manager/BandManager.php';
use Controllers\Manager\BandManager;
    
    //Delete en database
    $deleteData = new BandManager('bands');
    $info = $deleteData->deleteById();

    //Delete dossier artiste
    $checkForDelete = new BandManager('bands');
    $check = $checkForDelete->readById("slug",$_POST["id"]);
    deleteDirectory("../../assets/images/bands/".$check["slug"]);

    header('Location: ../Controllers/BandGestion.php');
    exit();


?>