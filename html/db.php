<?php
$host = getenv('DB_HOST') ?: 'db';  // 環境変数からDBホスト名を取得。デフォルトは'db'
$db   = getenv('DB_NAME') ?: 'mydatabase';
$user = getenv('DB_USER') ?: 'user';
$pass = getenv('DB_PASS') ?: 'password';
$port = getenv('DB_PORT') ?: "5432";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    echo "接続できなかったぽいね";
}
?>