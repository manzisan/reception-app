<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'recep');

$option = array(
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // デフォルトのエラー発生時の処理方法を指定
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // SELECT 等でデータを取得する際の型を指定
  PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
    // SELECT した行数を取得する関数 rowCount() が使える
  PDO::ATTR_EMULATE_PREPARES => false,
    // MySQLネイティブのプリペアドステートメント機能の代わりにエミュしたものを使う設定
  PDO::ATTR_STRINGIFY_FETCHES => false
    // 取得時した内容を文字列型に変換するかのオプション,int型も文字列扱い
);

//db接続
$dsn = 'mysql:dbname='.DB_NAME.';host=' . DB_HOST . ';charset=utf8';
try {
  $pdo = new PDO($dsn, DB_USER, DB_PASS, $option);
} catch (PDOException $e){
  echo $e->getMessage();
}
