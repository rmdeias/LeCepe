<?php
session_start();
require_once '../Controllers/Manager/AcessManager.php';
use Controllers\Manager\AcessManager;

// supprime la ligne sélectionné dans la database en comparant le Password saisie dans passconfirm avec le Password de la session
if(isset($_GET["id"]) && password_verify ($_POST["Password"], $_SESSION["admin"]["Password"])) { 
        
    $deleteData = new AcessManager('db_info');
    $info = $deleteData->deleteById();
    header('Location: ../Controllers/AdminGestion.php');
    exit();
}
else{
    die("Password incorect");
}

require "../views/FormDeleteConfirmation.phtml";
?>