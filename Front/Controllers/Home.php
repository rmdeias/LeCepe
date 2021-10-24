<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';
$title = "Le Cépe Records";
$allProducts = new ReadDeleteManager('products');
$products = $allProducts->readInnerJoinAllReleases('products.*,name,bandSlug',"WHERE products.dispo != 'New'");
$newReleases =$allProducts->readInnerJoinAllReleases('products.*,name,bandSlug',"WHERE products.dispo = 'New'");

require "./Front/Views/Home.phtml";
require "./Front/Views/Layout.phtml";