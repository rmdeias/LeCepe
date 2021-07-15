<?php
session_start();
require_once '../Controllers/Manager/AcessManager.php';
require_once '../Controllers/Entity/Acess.php';
use Controllers\Manager\AcessManager;
use Controllers\Entity\Acess;


$entity = new Acess();
$entity->setAcess($_POST["Acess"]);
$entity->setDbHost($_POST["DB_Host"]);
$entity->setDbUser($_POST["DB_User"]);
$entity->setDbPort($_POST["DB_Port"]);
$entity->setDataName($_POST["DataName"]);
$entity->setAuth($_POST["Auth"]);
$entity->setSecure($_POST["Secure"]);

// Modification 
if(isset($_POST["id"])) {
    
    /* demande confirmation pass current Admin */
    if(password_verify($_POST["Password"], $_SESSION["admin"]["Password"])) { 
        
        $checkDbPassForUpdate = new AcessManager('db_info');
        $pass = $checkDbPassForUpdate->readById("DB_Pass",$_POST["id"]);

        $pass = openssl_decrypt ($pass["DB_Pass"] , $ciphering, $decryption_key, $options, $encryption_iv);//decrypte $_POST["DB_Pass"] de la database 

        if( $_POST["DB_Pass"] === "") // Si aucune saisie pour DB_Pass
        {
            $_POST["DB_Pass"] = $pass;
        }

        $entity->setDbPass(openssl_encrypt($_POST["DB_Pass"], $ciphering, $encryption_key, $options, $encryption_iv));//encrypte $_POST["DB_Pass"] 
        $entity->setId($_POST["id"]);

        $checkDbPassForUpdate->update($entity); 
    }
    else{
        die("Password incorrectes");
    }
} 
// Creation d'une nouvelle ligne 
else{
   
    $entity->setDbPass(openssl_encrypt($_POST["DB_Pass"], $ciphering, $encryption_key, $options, $encryption_iv));//encrypte $_POST["DB_Pass"] 

    $insertInfo = new AcessManager('db_info');
    $insertInfo->create($entity);
}

header('Location: ../Controllers/AdminGestion.php');
exit;

?>  