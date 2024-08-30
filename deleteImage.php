<?php

include('./dbConfig.php');

$targetDirectiry ='../images/';
$imageId =$_GET['id'];

if(!empty($imageId)) {
    $sql = "SELECT file_name FROM images WHERE id =" . $imageId;

    $sth = $db->prepare($sql);
    $sth->execute();
    $getImageName = $sth->fetch();

    $deleteImage = unlink($targetDirectiry . $getImageName['file_name']);

    if($deleteImage) {
        $deleteRecord = $db->query("DELETE FROM images WHERE id = " . $imageId);
        
        if($deleteRecord) {
            header('Location:' . './index.php', true, 303);
            exit();
            
        }
    }
}

?>