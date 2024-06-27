<?php
$host = 'db';
$db   = 'mydatabase';
$user = 'user';
$pass = 'password';
$port = "5432";

$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";
try {
    $pdo = new PDO($dsn);
    if ($pdo) {
        echo "Connected to the PostgreSQL database successfully!<br>";
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
