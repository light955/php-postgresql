<?php
// 環境変数からDATABASE_URLを取得
$databaseUrl = getenv('DATABASE_URL');
if ($databaseUrl) {
    $dsn = $databaseUrl;
} else {
    echo "Database connection failed: DATABASE_URL environment variable not set.";
    exit;
}

try {
    $pdo = new PDO($dsn);
    if ($pdo) {
        echo "Connected to the PostgreSQL database successfully!<br>";

        // テーブルの作成
        $createTableSql = "CREATE TABLE IF NOT EXISTS users (
            id SERIAL PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL
        )";
        $pdo->exec($createTableSql);
        echo "Table 'users' created successfully!<br>";

        // データの挿入
        $insertDataSql = "INSERT INTO users (name, email) VALUES 
            ('John Doe', 'john.doe@example.com'),
            ('Jane Smith', 'jane.smith@example.com')";
        $pdo->exec($insertDataSql);
        echo "Data inserted successfully!<br>";
        
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