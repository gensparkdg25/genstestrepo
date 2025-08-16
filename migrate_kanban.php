<?php
$pdo = new PDO("mysql:host=localhost;dbname=testrepo", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "
CREATE TABLE IF NOT EXISTS kanban_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE,
    end_date DATE,
    assigned_to VARCHAR(100),
    column_name ENUM('todo','inprogress','done') NOT NULL DEFAULT 'todo',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
";

$pdo->exec($sql);

echo "✅ Kanban table created successfully!";