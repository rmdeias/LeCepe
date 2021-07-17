<?php
session_start();
require_once '../Controllers/Manager/BandManager.php';
use Controllers\Manager\BandManager;
      
    $deleteData = new BandManager('bands');
    $info = $deleteData->deleteById();
    header('Location: ../Controllers/BandGestion.php');
    exit();


?>