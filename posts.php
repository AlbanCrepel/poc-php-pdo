<?php

// Include database once to reuse the same connexion later
include_once("./db/database.php");

$stmt = $db->query('SELECT id, title, description, user_id, created_at FROM posts');
$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

$posts = array_map(fn(array $row) => Post::fromArray($row), $rows);

echo json_encode($rows);

?>
