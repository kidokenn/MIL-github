<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//1. POSTデータ取得
$id   = $_GET["id"];

//2. DB接続します
include("funcs.php");  //funcs.phpを読み込む（関数群）
$pdo = db_conn();      //DB接続関数

//LOGINチェック
sschk();

//３．データ登録SQL作成
$sql = "DELETE FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    if($_SESSION["kanri_flg"]=="1"){
        redirect("bm_view_list_for_manager.php");
    }
    if($_SESSION["kanri_flg"]=="0"){
        redirect("bm_view_list_for_user.php");
    }
}

?>
