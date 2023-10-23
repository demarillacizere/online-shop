<?php

namespace OnlineShop\Controllers;

use OnlineShop\Entities\Products;
use OnlineShop\Entities\Categories;
use OnlineShop\Entities\Users;

class MainController extends A_Controller
{
    const NUMBER_OF_PRODUCTS_ON_THE_MAIN_PAGE = 12;

    protected function indexAction(): void
    {
        $products = new Products();
        $productList = $products->findAll();
        $productList = array_slice($productList, 0, self::NUMBER_OF_PRODUCTS_ON_THE_MAIN_PAGE);
        $this->dataToRender['products'] = $productList;
        $categories =  new Categories();
        $categoriesList = $categories->findAll();
        $this->dataToRender['categories'] = $categoriesList;
        $this->dataToRender['showBanner'] = true;
        echo $this->view->render('index', $this->dataToRender);
    }

    protected function editAction(): void
    {
        // TODO: Implement addAction() method.
    }

    protected function deleteAction(): void
    {
        // TODO: Implement addAction() method.
    }

    protected function addAction(): void
    {
        // TODO: Implement addAction() method.
    }

    protected function pageNotFoundAction(): void
    {
        $this->dataToRender["pageTitle"] = 'Page not found!';
        echo $this->view->render('404', $this->dataToRender);
    }
}