<?php

include('./dbConfig.php');
//データベースとの接続コード//

$targetDirectory = '../images/';
$fileName =basename($_FILES["file"]["name"]);
$targetFilePath = $targetDirectory . $fileName;
//画像の保存先を指定してる//
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
//拡張子をとってきてる//

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $arrImageTypes)) {
        $postImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);

        if ($postImageForServer) {
            $insert = $db->query("INSERT INTO images (file_name) VALUES ('" . $fileName . "')");
        }
    }
}

header('Location: ' . ' ./index.php' , true, 303);
exit();
