<?php
//All SQL queries related to the Note model are handled here.

namespace App\Models;
use App\Core\BaseModel;

use PDO;


class Note extends BaseModel
{

       public function all()
    {
        $stmt = $this->db->query("SELECT * FROM notes ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM notes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  public function createsNotes($title, $content)
  {
    $stmt = $this->db->prepare("INSERT INTO notes (title, content, created_at) VALUES (?, ?, NOW())");
    return $stmt->execute([$title, $content]);
  }

  public function update($id, $title, $content)
    {
       $stmt = $this->db->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM notes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}