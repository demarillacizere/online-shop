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
        echo $this->view->render('list', $this->dataToRender);
    }

    protected function editAction(): void
    {
        $this->checkAccess();
        $id = Router::$idURLParameter;
        $cart = new Cart();
        $cartData[Cart::DB_TABLE_FIELD_QNT] = htmlentities($_POST['newQuantity']);
        $cartData[Cart::DB_TABLE_FIELD_TOTALPRICE] = htmlentities($_POST['newTotal']);
        var_dump($cartData);
        $cart = new Cart();
        $result = $cart->update($id, $cartData);
        if ($result === true) {
            $this->dataToRender['success'] = "Cart has been updated.";
            // Construct a response
            $response = array('success' => true, 'message' => 'Cart updated successfully');

            // Send the response in JSON format
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $this->dataToRender['error'] = "Error updating the cart! Please try one more time!";
        }
    }

    protected function deleteAction(): void
    {
        $this->checkAccess();
        $id = Router::$idURLParameter;
        $cart = new Cart();
        $result = $cart->deleteByProductId($id);
        if ($result === true) {
            $this->dataToRender['success'] = "Product has been deleted from cart.";
        } else {
            $this->dataToRender['error'] = "Deletion failed! Please try one more time!";
        }
        header('Location:' . BASE_URL . 'cart');

    }

    protected function addAction(): void
    {
        $this->checkAccess();
        $cartData[Cart::DB_TABLE_FIELD_PRODUCT] = (int) (htmlentities($_POST['productId']));
        $product = new Products();
        $productData = $product->findById($cartData[Cart::DB_TABLE_FIELD_PRODUCT]);
        if (empty($productData)) {
            header('Location: /notfound');
        }

        $cartData[Cart::DB_TABLE_FIELD_QNT] = htmlentities($_POST['quantity']);
        $cartData[Cart::DB_TABLE_FIELD_TOTALPRICE] = htmlentities($_POST['quantity'] * $_POST['productPrice']);
        $cartData[Cart::DB_TABLE_FIELD_USERID] = $_SESSION['user']['id'];
        $cart = new Cart();
        $result = $cart->insert($cartData);
        if ($result === true) {
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
        echo $this->view->render('checkout', $this->dataToRender);

    }

    protected function placeOrderAction(): void
    {
        $result = true;
        $this->checkAccess();
        $cart = new Cart();
        $cartItems = $cart->findAllByUserId($_SESSION['user']['id']);
        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                $cartId = $item['id'];
                $result &= $cart->updateCartItemAsChekedout($cartId);
            }
        }

        if ($result) {
            header("Location:" . BASE_URL . " /thankyou");
        } else {
            $this->dataToRender['error'] = "Something went wrong upon checkout. Please try again.";
            header("Location: /cart");
        }
    }

    private function getRandomProductsShuffle(int $numberOfProducts): array
    {
        $product = new Products();
        $products = $product->findAll();
        shuffle($products);
        return array_slice($products, 0, $numberOfProducts);
    }

    protected function thankyouAction(): void
    {
        $this->checkAccess();
        echo $this->view->render('thankyouPage', $this->dataToRender);
    }
}