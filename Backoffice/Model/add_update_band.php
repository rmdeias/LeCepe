<?php
session_start();
require_once '../Controllers/Manager/BandManager.php';
require_once '../Controllers/Entity/Band.php';
use Controllers\Manager\BandManager;
use Controllers\Entity\Band;

function uploadPhotoBand($path)// Vérifie si le fichier a été uploadé sans erreur.
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if (isset($_FILES["imageBand"]) && $_FILES["imageBand"]["error"] == 0) {
            $allowed = array(
                "jpg" => "image/jpg",
                "jpeg" => "image/jpeg",
                "gif" => "image/gif",
                "png" => "image/png",
            ); //tableau extension valide
            $filename ="le-cepe-records-". $_FILES["imageBand"]["name"];
            $filetype = $_FILES["imageBand"]["type"];
            $filesize = $_FILES["imageBand"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION); //extension du fichier
            $maxsize = 5 * 1024 * 1024; // taille max a ne pas dépasser

            if (!array_key_exists($ext, $allowed)) //Si extension n'est pas trouvé dans le tab, fichier non valide
            {
                die("Erreur : Veuillez sélectionner un format de fichier valide.");
            }

            if ($filesize > $maxsize) // Vérifie la taille du fichier - 5Mo maximum
            {
                die("Error: La taille du fichier est supérieure à la limite autorisée.");
            }

            // Vérifie le type MIME du fichier
            if (in_array($filetype, $allowed)) {
                // Vérifie si le fichier existe avant de le télécharger.
                if (file_exists($path.$filename)) {
                    die($filename." existe déjà.");
                } else {
                    if (!is_dir(
                        $path
                    ))// Si le dossier n'existe pas
                    {
                        mkdir(
                            $path,
                            0777,
                            true
                        ); // création dossier
                    }

                    // ajout de la photo de couverture dans le dossier
                    move_uploaded_file(
                        $_FILES["imageBand"]["tmp_name"],
                        $path.$filename 
                    ); 
                
                    echo "Votre fichier a été téléchargé avec succès.";
                }
            } else {
                die("Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.");
            }
        } else {
            die ("Error: ".$_FILES["imageBand"]["error"]);
        }

    }
}



$entity = new Band();

$entity->setName($_POST["name"]);
$entity->setImage("le-cepe-records-".$_FILES["imageBand"]["name"]);
$entity->setDescription($_POST["description"]);
$entity->setLinkFB($_POST["linkFB"]);
$entity->setLinkInsta($_POST["linkInsta"]);
$entity->setLinkYoutube($_POST["linkYoutube"]);
$entity->setLinkBandcamp($_POST["linkBandcamp"]);
$entity->setIframeYoutube($_POST["iframeYoutube"]);


if(strpos($_POST["name"] , "&" )){

    $entity->setSlug(str_replace("&", "and", $_POST["name"]));
    $entity->setSlug(str_replace(" ", "-", $entity->getSlug()));
}
else{
    $entity->setSlug(str_replace(" ", "-", $_POST["name"]));
}
    
$path = "../../assets/images/bands/". $entity->getSlug()."/";
//$entity->setIdBand($_POST["price"]);

// Modification 
if(isset($_POST["id"])) {
    
    $updateInfo = new BandManager('bands');
    $entity->setId($_POST["id"]);
    $updateInfo->update($entity);    
} 
// Creation d'une nouvelle ligne 
else{
    
    // recherche "/" dans le nom pour éviter la création d'un sous dossier ou d'une balise fermante html
    if (strpos(htmlspecialchars($_POST["name"]),"/") == false){
        
        uploadPhotoBand($path);
        $insertInfo = new BandManager('bands');
        $insertInfo->create($entity);
    }
    else{
        die("Le nom de doit pas contenir /");
    }
}

header('Location: ../Controllers/BandGestion.php');
exit;

?>  