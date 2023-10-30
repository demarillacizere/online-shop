<?php

namespace OnlineShop\Controllers;

use OnlineShop\App\Router;
use OnlineShop\Entities\Products;
use OnlineShop\Entities\Categories;

class CategoriesController extends A_Controller
{
    protected function indexAction(): void
    {
        $id = Router::$idURLParameter;
        $product = new Products();
        $productData = $product->findAllByCategoryId($id);
        if(empty($productData)) {
            header('Location: /online-shop/notfound');
        }
        $category = new Categories();
        $categoryName = $category->findById($id);
        $this->dataToRender['categoryName'] = $categoryName['name'];
        $this->dataToRender['products'] = $productData;
        echo $this->view->render('index', $this->dataToRender);
    }

    protected function editAction(): void
    {
        // TODO: Implement editAction() method.
    }

    protected  function deleteAction(): void
    {
        // TODO: Implement deleteAction() method.
    }

    protected  function addAction(): void
    {
        // TODO: Implement addAction() method.
    }

    private function getRandomProducts(int $numberOfProducts): array
    {
        $products = [];
        $product = new Products();
        $maxId = $product->findMaximalId();
        for($i = 0; $i < $numberOfProducts; $i++){
            $randomId = rand(1, $maxId);
            $products[] = $product->findById($randomId);
        }

        return $products;
    }

    private function getRandomProductsShuffle(int $numberOfProducts): array
    {
        $product = new Products();
        $products = $product->findAll();
        shuffle($products);
        return array_slice($products, 0, $numberOfProducts);
    }
}