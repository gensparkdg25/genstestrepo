<?php
namespace App\Models;
use App\Core\BaseModel;
use PDO;

class Post extends BaseModel
{
    // Get all posts
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create a new post
    public function createPost($title, $content) {
        $stmt = $this->db->prepare("
            INSERT INTO posts (title, content, created_at) 
            VALUES (?, ?, NOW())
        ");
        $stmt->execute([$title, $content]);

        // Return the inserted post
        $id = $this->db->lastInsertId();
        return $this->getPostById($id);
    }

    // Get a single post by ID
    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update a post
    public function updatePost($id, $title, $content) {
        $stmt = $this->db->prepare("
            UPDATE posts SET title = ?, content = ? WHERE id = ?
        ");
        return $stmt->execute([$title, $content, $id]);
    }

    // Delete a post
    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
