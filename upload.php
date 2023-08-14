<?php
function upload($pic){
    if ($pic['error']==4 ) {
        $picturename='avatar.png';
        $mesage='no picture select';
    }else {
        $checkifimage= getimagesize($pic['tmp_name']);
        $mesage=$checkifimage ? "OK" : "NOT A IMAGE";
    }
    if ($mesage== 'OK') {
        $ext=strtolower(pathinfo($pic['name'],PATHINFO_EXTENSION));
        $picturename=uniqid(''). '. '. $ext;
        $destination = "picture/{$picturename}"; // where the file will be saved
        move_uploaded_file($pic['tmp_name'],$destination);
    }else if ($mesage=='NOT A IMAGE') {
        $picturename='avatar.png';
        $mesage='Ist not a image';

    }
    return [$picturename,$mesage];
    
}