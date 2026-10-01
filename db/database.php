<?php

include_once("./db/Post.php");

// Using postgres
//$connexionString = "host=localhost port=5432 dbname=db user=postgres password=password";
//$db = pg_connect($connexionString);

$dsn = 'sqlite::memory:';
$db = new \PDO($dsn);

// Enable foreign key constraint enforcement (off by default in SQLite)
$db->exec('PRAGMA foreign_keys = ON');

// Starting from scratch because the db is in-memory: we create the tables and insert some data

// users table
$db->exec('
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
');

// posts table, linked to users
$db->exec('
    CREATE TABLE IF NOT EXISTS posts (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        user_id INTEGER NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )
');


$stmt = $db->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
$stmt->execute([
    'email' => 'admin@admin.com',
    'password' => password_hash('password', PASSWORD_BCRYPT),
]);

$userId = $db->lastInsertId();

$stmt = $db->prepare('INSERT INTO posts (title, description, user_id) VALUES (:title, :description, :user_id)');
$stmt->execute([
    'title' => 'My first post',
    'description' => 'Some content here',
    'user_id' => $userId,
]);

?>
