<?php
session_start();
require_once '../Controllers/Manager/ProductManager.php';
use Controllers\Manager\ProductManager;
      
    $deleteData = new ProductManager('products');
    $info = $deleteData->deleteById();
    header('Location: ../Controllers/ProductGestion.php');
    exit();


?>