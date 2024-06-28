<?php
$host = getenv('DB_HOST') ?: 'db';  // 環境変数からDBホスト名を取得。デフォルトは'db'
$db   = getenv('DB_NAME') ?: 'mydatabase';
$user = getenv('DB_USER') ?: 'user';
$pass = getenv('DB_PASS') ?: 'password';
$port = getenv('DB_PORT') ?: "5432";

$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";
try {
    $pdo = new PDO($dsn);
    if ($pdo) {
        echo "接続できた力斗さん(環境変数もばっちり)<br>";
        
        // テーブルの作成
        $createTableSql = "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL
        )";
        $pdo->exec($createTableSql);
        echo "Table 'users' created successfully!<br>";

        
        
        // データの取得と表示
        $stmt = $pdo->query("SELECT * FROM users");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row['id'] . " Name: " . $row['name'] . " Email: " . $row['email'] . "<br>";
        }
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
