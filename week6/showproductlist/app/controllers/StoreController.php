<?php
require_once __DIR__ . '/../models/StoreModel.php';
require_once __DIR__ . '/../core/Controller.php';

class StoreController extends Controller
{
    public function index()
    {
        $storeModel = new StoreModel();
        $stores = $storeModel->getAll();
        $this->view('store', ['stores' => $stores]);
    }
}
$storeController = new StoreController();
$storeController->index();