<?php

namespace OnlineShop\Controllers;

use OnlineShop\App\Router;
use OnlineShop\Entities\Cart;
use OnlineShop\Entities\Products;
use OnlineShop\Controllers\ProductsControllerController;

class CartController extends A_Controller
{

    protected function indexAction(): void
    {
        $this->checkAccess();

        $cart = new Cart();
        $cartItems = $cart->findAllByUserIdJoinWithProducts($_SESSION['user']['id']);
        $this->dataToRender['items'] = $cartItems;
        var_dump($this->dataToRender['items']);
        echo $this->view->render('list', $this->dataToRender);
    }

    protected function editAction(): void
    {
        // TODO: Implement editAction() method.
    }

    protected function deleteAction(): void
    {
        $this->checkAccess();
        $id = Router::$idURLParameter;
        $cart = new Cart();
        $result = $cart->deleteByProductId($id);
        if($result === true) {
            $this->dataToRender['success'] = "Product has been deleted from cart.";
        } else{
            $this->dataToRender['error'] = "Deletion failed! Please try one more time!";
        }
        header('Location:'.BASE_URL.'cart');

    }

    protected function addAction(): void
    {
        $this->checkAccess();
        $cartData[Cart::DB_TABLE_FIELD_PRODUCT] = (int)(htmlentities($_POST['productId']));
        $product = new Products();
        $productData = $product->findById($cartData[Cart::DB_TABLE_FIELD_PRODUCT]);
        if(empty($productData)) {
            header('Location: /notfound');
        }

        $cartData[Cart::DB_TABLE_FIELD_QNT] = htmlentities($_POST['quantity']);
        $cartData[Cart::DB_TABLE_FIELD_USERID] = $_SESSION['user']['id'];
        $cart = new Cart();
        $result = $cart->insert($cartData);
        if($result === true) {
            $this->dataToRender['success'] = "Product has been added to your cart.";
            $this->getNumberFromCart();
        } else {
            $this->dataToRender['error'] = "Product has NOT been added to your cart. Please try again.";
        }
        $this->dataToRender['products'] = $this->getRandomProductsShuffle(4);
        $this->dataToRender['product'] = $productData;
        echo $this->view->render('index', $this->dataToRender);
    }

    protected function checkoutAction(): void
    {
        $cart = new Cart();
        $cartItems = $cart->findAllByUserIdJoinWithProducts($_SESSION['user']['id']);
        $this->dataToRender['items'] = $cartItems;
        var_dump($this->dataToRender['items']);
        echo $this->view->render('checkout', $this->dataToRender);

    }

    protected function placeOrderAction(): void
    {
        $result = true;
        $this->checkAccess();
        $cart = new Cart();
        $cartItems = $cart->findAllByUserId($_SESSION['user']['id']);
        if(!empty($cartItems)) {
            foreach ($cartItems as $item){
                $cartId = $item['id'];
                $result &= $cart->updateCartItemAsChekedout($cartId);
            }
        }

        if($result) {
            header("Location:".BASE_URL." /thankyou");
        } else {
            $this->dataToRender['error'] = "Something went wrong upon checkout. Please try again.";
            header("Location: /cart");
        }
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

    protected function thankyouAction(): void
    {
        $this->checkAccess();
        echo $this->view->render('thankyouPage', $this->dataToRender);
    }
}