<?php
$uri = $_SERVER['REQUEST_URI']; //スーパーグローバル変数
if (strpos($uri, 'imageDetail.php') !== false) {
    $imageId = $_GET['id'];
    $sql = "SELECT * FROM images WHERE id = " . $imageId;

    $sth = $db->prepare($sql);
    $sth->execute();
    $data['image'] = $sth->fetch();

    $sql2 = "SELECT * FROM comments WHERE image_id = " . $imageId . " ORDER BY create_date DESC";
          //コメント機能                                           //ORDER BYで最新のコメントを一番前にする
    $sth = $db->prepare($sql2);
    $sth->execute();
    $data['comments'] = $sth->fetchAll();
    $countComment = count($data['comments']);
    //count->カウントとよむ

} else{

    $sql = "SELECT * FROM images ORDER BY create_date DESC";
    //並び替えするカラム名  昇順[ASC]降順[DESC]
    //データベースに投稿した画像のデータを持って来て作成日で順番を入れ替える
    $sth = $db->Prepare($sql);
    $sth->execute();
    $data = $sth->fetchAll();
    //Prepare(プリペア)＝準備
    //execute(エグゼキュート)＝実行
    //fetchAll(フェッチオール)＝全部取り出す
}
return $data;
    
    //return文 戻り値の設定、処理を終了させて呼び出し元に値を返すことができる
?>