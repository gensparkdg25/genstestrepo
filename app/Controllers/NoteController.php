<?php
namespace App\Controllers;
use App\Core\Controller;

class NoteController extends Controller
{
    public function index()
    {
        $notes = $this->model("Note")->all();
        $this->view("notes/index", ['notes' => $notes]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model("Note")->createsNotes($_POST['title'], $_POST['content']);
            echo "<script>alert('Note created!');window.location='" . BASE_URL . "NoteController/index';</script>";
            exit;
        }
        $this->view("notes/create");
    }

    public function edit($id)
    {
        $model = $this->model("Note");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->update($id, $_POST['title'], $_POST['content']);
            echo "<script>alert('Note updated!');window.location='" . BASE_URL . "NoteController/index';</script>";
            exit;
        }
        $note = $model->find($id);
        $this->view("notes/edit", ['note' => $note]);
    }

    public function delete($id)
    {
        $this->model("Note")->delete($id);
        echo "<script>alert('Note deleted!');window.location='" . BASE_URL . "NoteController/index';</script>";
        exit;
    }
}
