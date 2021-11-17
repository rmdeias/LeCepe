<?php
use Controllers\Manager\ReadDeleteManager;
require_once 'Backoffice/Controllers/Manager/ReadDeleteManager.php';
$title = "Le Cépe Records - Home";
$allProducts = new ReadDeleteManager('products');
$products = $allProducts->readInnerJoinAllReleases('products.*,name,bandSlug',"WHERE products.dispo != 'New' AND name != 'LeCepeRecords Merch'");
$newReleases =$allProducts->readInnerJoinAllReleases('products.*,name,bandSlug',"WHERE products.dispo = 'New' AND name != 'LeCepeRecords Merch'");

require "./Front/Views/Home.phtml";
require "./Front/Views/Layout.phtml";