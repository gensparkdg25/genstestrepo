<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;

    public static function connection()
    {
        if (!self::$instance) {
            try {
                // Use constants from Config.php
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
                self::$instance = new PDO($dsn, DB_USER, DB_PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
