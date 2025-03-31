<?php
require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../core/Controller.php';

class ProductController extends Controller
{
    public function index()
    {
        $productModel = new ProductModel();
        $products = $productModel->getAll();
        $this->view('product', ['products' => $products]);
    }
}
$productController = new ProductController();
$productController->index();