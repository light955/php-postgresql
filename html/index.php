<?php
require 'db.php'; // データベース接続を確立

try {
    $sql = "SELECT posts.*, users.name AS user_name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
    $stmt = $pdo->query($sql);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Posts</title>
</head>
<body>
    <h1>Posts</h1>
    <a href="create_post.php">Create Post</a>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
                <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                <small>by <?php echo htmlspecialchars($post['user_name']); ?> at <?php echo htmlspecialchars($post['created_at']); ?></small>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
