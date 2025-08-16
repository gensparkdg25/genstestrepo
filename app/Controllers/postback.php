<?php
namespace App\Controllers;
use App\Core\Controller;

class PostController extends Controller
{
    public function index() {
        $posts = $this->model("Post")->getAll();
        $this->view("post/index", ['post' => $posts]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $title = $_POST['title'] ?? '';
                $content = $_POST['content'] ?? '';

                if (empty($title) || empty($content)) {
                    throw new \Exception("Title and Content cannot be empty.");
                }

                $this->model("Post")->createPost($title, $content);

                echo "<script>
                        alert('Posted successfully!');
                        window.location='" . BASE_URL . "PostController/index';
                      </script>";
                exit;

            } catch (\Exception $e) {
                // Alert error message
                $error = htmlspecialchars($e->getMessage());
                echo "<script>alert('Error: $error');window.history.back();</script>";
                exit;
            }
        }

        $this->view("post/index");
    }
}
