<?php

$page = $_GET["page"] ?? 'Home';
$controller = './Front/Controllers/'.$page.'.php';
if (file_exists($controller)) {
    require $controller;
    exit;
}

$controller = null;
/*

if (!isset($_SESSION["admin"])) {
    http_response_code(404);
    require "Controllers/Error404.php";
    die();
}*/

switch ($_GET["page"]) {
    case"Artists":
        $controller = "./Front/Controllers/Artists";
        break;

    case"Band":
        $controller = "./Front/Controllers/Band";
        break;

    case"Product":
        $controller = "./Front/Controllers/Product";
        break;

    case"Merch":
        $controller = "./Front/Controllers/Merch";
        break;
}
/*
if (!$controller) {
    http_response_code(404);
    require "Controllers/pages/Error404.php";
    die();
}*/

require $controller;