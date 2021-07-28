<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';

$allProducts = new ReadDeleteManager('products');
$products = $allProducts->readInnerJoin('products.*,name,bandSlug');

require "./Front/Views/Home.phtml";
require "./Front/Views/Layout.phtml";