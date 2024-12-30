<?php
namespace App\Controllers;
use App\Models\Post;
use App\Controller;
require_once 'bootstrap.php';  // Khởi động session từ file bootstrap

class OrderController extends Controller
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    public function index()
    {
        // Fetch all posts and display them in a view
        $posts = $this->postModel->getAllPosts();

        $this->render('posts\post-list', ['posts' => $posts]);
    }

    public function show($postId)
    {
        // Fetch a single post by ID and display in a view
        $post = $this->postModel->getPostById($postId);

        $this->render('posts\post-form', ['post' => $post]);

    }

    public function create()
    {
        if (empty($_SESSION['currentUser'])) {
            header("Location: ../user/signin");
            exit();
        }
        // Handle form submission to create a new post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $title = $_POST['title'];
            $content = $_POST['content'];
            
            // Call the model to create a new post
            $this->postModel->createPost($title, $content);
        }

        // Display the form to create a new post
        
        $this->render('posts\post-form', ['post' => []]);

    }
    public function postList()
    {
        // if (empty($_SESSION['currentUser'])) return header("Location: ../user/signin");
        // Fetch all users and display them in a view
        $posts = $this->postModel->getAllPosts();
        
        $this->render('posts\user-list', ['posts' => $posts]);
    }

    public function update($postId)
    {
        if (empty($_SESSION['currentUser'])) {
            header("Location: ../user/signin");
            exit();
        }
        // Handle form submission to update a post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $title = $_POST['title'];
            $content = $_POST['content'];
            
            // Call the model to update the post
            $this->postModel->updatePost($postId, $title, $content);
        }

        // Fetch the post data and display the form to update
        $post = $this->postModel->getPostById($postId);
        
        $this->render('posts\post-form', ['post' => $post]);
    }

    public function delete($postId)
    {
        if (empty($_SESSION['currentUser'])) {
            header("Location: ../user/signin");
            exit();
        }
        // Call the model to delete the post
        $this->postModel->deletePost($postId);

        // Redirect to the index page after deletion
        header('Location: /index.php');
    }
}