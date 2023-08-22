<?php
function fileUpload($pic, $type)
{
    if ($pic["error"] == 4) {
        $pictureName = "placeholder.jpg";
        $message = "No picture has been chosen, but you can upload an image later.";
    } else {
        $checkIfImage = getimagesize($pic["tmp_name"]);
        $message = $checkIfImage ? "Success" : "The file chosen was not an image";
    }

    if ($message == "Success") {

        $ext = strtolower(pathinfo($pic["name"], PATHINFO_EXTENSION));

        $pictureName = uniqid("") . "." . $ext;

        if ($type == 'user') {
            $destination = "../images/users/{$pictureName}";
        }   $destination = "../images/pets/{$pictureName}"; 
        move_uploaded_file($pic["tmp_name"], $destination);
    }
     elseif ($message == "The file chosen was not an image") {
        $pictureName = "placeholder.jpg";
    }

    return [$pictureName, $message];
}
 
            