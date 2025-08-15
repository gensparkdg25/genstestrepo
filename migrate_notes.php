<?php
$pdo = new PDO("mysql:host=localhost;dbname=testrepo", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "
CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

$pdo->exec($sql);
echo "✅ Notes table created successfully!";


//cd C:\xampp\htdocs
//php migrate_notes.php
