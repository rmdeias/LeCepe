<?php
session_start();
use Controllers\Manager\AcessManager;
require_once 'Manager/AcessManager.php';

// empeche de revenir sur cette page apres déconnection
if (isset($_SESSION['admin'])) {
        
        $title = "Confirmation Password";

        $readAcess = new AcessManager('db_info');
        $info = $readAcess ->readById('Acess',$_GET["id"]);

        if(isset($_GET["id"]) && isset($_POST["Password"])) {
                
                header("Location: ../Model/delete.php?id=" .$_GET["id"]);
                exit();
        }
        
        include "../views/FormDeleteConfirmation.phtml";
}
else{
        http_response_code(404);
        header('Location: Home.php');
        exit;
    }
?>