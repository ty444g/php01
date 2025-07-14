<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// フォームからの入力を取得
$cafe = $_POST["cafe"]   ?? '';
$menu = $_POST["menu"]   ?? '';
$memo = $_POST["memo"]   ?? '';

// 送信時刻を YYYY-MM-DD HH:MM:SS 形式で取得
$sentAt = date('Y-m-d H:i:s');

// 書き込むデータを配列で用意
$row = [
    $cafe,    // カフェ名
    $menu,    // メニュー
    $memo,    // 備考
    $sentAt,  // 送信時刻
];

// CSV ファイルを追記モードでオープンし、fputcsv で書き込み
$file = fopen("cafe.csv", "a");
if ($file === false) {
    // ファイルオープンに失敗したらエラー処理
    die("ファイルを開けませんでした。");
}
fputcsv($file, $row);
fclose($file);

// 登録後は一覧ページ（あるいはトップ）へリダイレクト
header("Location: index.php");
exit;
?>
