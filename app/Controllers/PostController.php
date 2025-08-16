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
            header('Content-Type: application/json');
            try {
                $title = trim($_POST['title'] ?? '');
                $content = trim($_POST['content'] ?? '');

                if (empty($title) || empty($content)) {
                    throw new \Exception("Title and Content cannot be empty.");
                }

                $this->model("Post")->createPost($title, $content);

                $posts = $this->model("Post")->getAll();
                $latestPost = $posts[0];

                echo json_encode([
                    'success' => true,
                    'post' => $latestPost,
                    'message' => 'Posted successfully!'
                ]);
                exit;

            } catch (\Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }
        }

        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }

    // --- EDIT POST ---
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            try {
                $title = trim($_POST['title'] ?? '');
                $content = trim($_POST['content'] ?? '');

                if (empty($title) || empty($content)) {
                    throw new \Exception("Title and Content cannot be empty.");
                }

                $updated = $this->model("Post")->updatePost($id, $title, $content);

                if (!$updated) {
                    throw new \Exception("Failed to update post.");
                }

                echo json_encode([
                    'success' => true,
                    'message' => 'Post updated successfully!'
                ]);
                exit;

            } catch (\Exception $e) {
                echo json_encode([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }
        }

        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }

    // --- DELETE POST ---
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            try {
                $deleted = $this->model("Post")->deletePost($id);
                if (!$deleted) throw new \Exception("Failed to delete post.");
                echo json_encode(['success' => true, 'message' => 'Post deleted successfully!']);
                exit;
            } catch (\Exception $e) {
                echo json_encode(['success' => false, 'message' => $e->getMessage()]);
                exit;
            }
        }
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit;
    }
}
