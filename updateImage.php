<?php

include('./dbConfig.php');

$targetDirectory = '../images/';
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDirectory . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$imageId = $_GET['id'];
//保存用パスを用意している

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($fileName)) {
    $arrImageTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $arrImageTypes)) {
        //画像がホームから送られてきてるか、画像が空じゃないか、画像が画像の拡張子か、を確認している
        $sql = "SELECT file_name FROM images WHERE id = " . $imageId;

        $sth = $db->prepare($sql);
        $sth->execute();
        $getImageName = $sth->fetch();
        //クエリパラメータの画面idを使って削除する画像名をとってきている
        $deleteImage = unlink($targetDirectory . $getImageName['file_name']);
        //とってきた画像名から22行目で削除
        if ($deleteImage) {
            $uploadImageForServer = move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath);
        //削除した画像新しくimagesホルダーに24行目から25行目で保存
            if($uploadImageForServer) {
                $update = $db->query("UPDATE images SET file_name = '" . $fileName . "' WHERE id = " . $imageId);
            //アップデート文で画像の更新
                header('Location: ' . './index.php', true, 303);
                exit();
            }
        }


    }
}

?>