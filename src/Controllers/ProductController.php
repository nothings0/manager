<?php
namespace App\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Controller;
require_once 'bootstrap.php';  // Khởi động session từ file bootstrap

class ProductController extends Controller
{
    private $productModel;
    private $categoryModel;
    
    public function __construct()
    {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    public function index()
    {
        // Fetch all products and display them in a view
        // $products = $this->productModel->getAllProducts();

        // $this->render('products\index', ['products' => $products]);

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 3; // Số bản ghi mỗi trang

        // Gọi model để lấy dữ liệu và tổng số bản ghi
        $products = $this->productModel->getPaginated($page, $limit);
        $totalUsers = $this->productModel->getTotal();

        // Tính toán số trang
        $totalPages = ceil($totalUsers / $limit);

        // Gửi dữ liệu tới view
        $this->render('products/index', [
            'products' => $products,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    }

    public function create()
    {
        // if (empty($_SESSION['currentUser'])) {
        //     header("Location: ../category/signin");
        //     exit();
        // }
        // Handle form submission to create a new product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $price = $_POST['price'];
            $isSelling = $_POST['isSelling'];
            $categoryID = $_POST['categoryID'];

            // Handle file upload
            $photo = '';
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/images/';
                $tmpName = $_FILES['photo']['tmp_name'];
                $fileName = basename($_FILES['photo']['name']);
                $filePath = $uploadDir . $fileName;

                // Move the uploaded file to the images folder
                if (move_uploaded_file($tmpName, $filePath)) {
                    $photo = $fileName;  // Save the file name to store in the database
                } else {
                    echo 'Failed to upload image.';
                    exit();
                }
            }

            // Call the model to create a new product
            $product = $this->productModel->createProduct($productName, $productDescription, $price, $photo, $isSelling, $categoryID);

            if ($product) {
                header('Location: /product');
                exit();
            } else {
                echo 'Product creation failed.';
            }
        } else {
            $categories = $this->categoryModel->getAllCategories();
            $this->render('products\add', [
                'product' => [],
                'categories' => $categories
            ]);
        }
    }

    public function update($productId)
    {
        // if (empty($_SESSION['currentUser'])) {
        //     header("Location: ../category/signin");
        //     exit();
        // }
        // Handle form submission to update a product
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $productName = $_POST['productName'];
            $productDescription = $_POST['productDescription'];
            $price = $_POST['price'];
            $isSelling = $_POST['isSelling'];
            $categoryID = $_POST['categoryID'];
            
            $photo = '';
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../public/images/';
                $tmpName = $_FILES['photo']['tmp_name'];
                $fileName = basename($_FILES['photo']['name']);
                $filePath = $uploadDir . $fileName;

                // Move the uploaded file to the images folder
                if (move_uploaded_file($tmpName, $filePath)) {
                    $photo = $fileName;  // Save the file name to store in the database
                } else {
                    echo 'Failed to upload image.';
                    exit();
                }
            }
            // Call the model to update the product
            $product = $this->productModel->updateProduct($productId, $productName, $productDescription, $price, $photo, $isSelling, $categoryID);

            if ($product) {
                header('Location: /product');
                exit();
            } else {
                echo 'Product creation failed.';
            }
        } else {
            $product = $this->productModel->getProductById($productId);       
            $categories = $this->categoryModel->getAllCategories();
            $this->render('products\edit', [
                'product' => $product,
                'categories' => $categories
            ]);
        }
    }

    public function delete($productId)
    {
        // if (empty($_SESSION['currentUser'])) {
        //     header("Location: ../product/signin");
        //     exit();
        // }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->productModel->deleteProduct($productId);
            header('Location: /product');    
        } else {
            $product = $this->productModel->getProductById($productId);
            $categories = $this->categoryModel->getAllCategories();
            $this->render('products\delete', [
                'product' => $product,
                'categories' => $categories
            ]);
        }
    }
}