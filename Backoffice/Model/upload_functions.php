<?php

function uploadPhoto($path, $postImage, $resizedWidth, $resizedHeight)// Vérifie si le fichier a été uploadé sans erreur.
{
    $newWidth = $resizedWidth;
    $newHeight = $resizedHeight;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if (isset($_FILES[$postImage]) && $_FILES[$postImage]["error"] == 0) {
            $allowed = array(
                "jpg" => "image/jpg",
                "jpeg" => "image/jpeg",
                "gif" => "image/gif",
                "png" => "image/png",
            ); //tableau extension valide
            $filename ="le-cepe-records-". $_FILES[$postImage]["name"];
            $filetype = $_FILES[$postImage]["type"];
            $filesize = $_FILES[$postImage]["size"];
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
                    if (!is_dir($path))// Si le dossier n'existe pas
                    {
                        mkdir($path,0777,true); // création dossier
                    }
                      // resize Image
                    list($width, $height, $type) = getimagesize( $_FILES[$postImage]["tmp_name"]);
                    $thumb = imagecreatetruecolor($newWidth, $newHeight);
                    $source = imagecreatefromjpeg( $_FILES[$postImage]["tmp_name"]);
                    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($thumb, $_FILES[$postImage]["tmp_name"]);
                 
                    // ajout de la photo le dans le dossier
                    move_uploaded_file(
                        $_FILES[$postImage]["tmp_name"],
                        $path.$filename 
                    ); 

                   
                
                    echo "Votre fichier a été téléchargé avec succès.";
                }
            } else {
                die("Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.");
            }
        } else {
            die ("Error: ".$_FILES[$postImage]["error"]);
        }

    }
}

function deleteDirectory($dir) //supprime dossier
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!deleteDirectory($dir.DIRECTORY_SEPARATOR.$item)) {
            return false;
        }
    }

    return rmdir($dir);
}

function copyDirectory($src, $dst) //copie dossier
{

    $dir = opendir($src);  // ouvert le dossier

    @mkdir($dst);  // Vérifie si le dossier n'existe pas deja

    foreach (scandir($src) as $file)// parcourt le dossier lister les fichier
    {
        if (($file != '.') && ($file != '..'))// évite les dossier parents
        {
            if (is_dir($src.'/'.$file)) {
                copyDirectory(
                    $src.'/'.$file,
                    $dst.'/'.$file
                ); // appel récursif copyDirectory pour potentiel sous dossier
            } else {
                copy($src.'/'.$file, $dst.'/'.$file);  // copie les fichiers
            }
        }
    }
    closedir($dir); // ferme le dossier
}