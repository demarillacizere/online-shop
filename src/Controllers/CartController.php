<?php

namespace OnlineShop\Controllers;

use OnlineShop\App\Router;
use OnlineShop\Entities\Cart;
use OnlineShop\Entities\Products;
use OnlineShop\Entities\Orders;
use OnlineShop\Entities\OrderItems;

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
            $response = array('success' => true, 'message' => 'Cart updated successfully');
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            $response = array('success' => false, 'message' => 'Error updating the cart');
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    protected function deleteAction(): void
    {
        $this->checkAccess();
        $id = Router::$idURLParameter;
        $cart = new Cart();
        $result = $cart->deleteById($id);
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
            header("Location:" . BASE_URL . " notfound");
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
        $this->checkAccess();
        $cart = new Cart();
        $cartItems = $cart->findAllByUserIdJoinWithProducts($_SESSION['user']['id']);
        $this->dataToRender['items'] = $cartItems;
        $cartTotal = 0;
        foreach ($cartItems as $item) {
            // Calculate the total for each item
            $cartTotal = $cartTotal + $item['total_price'];
        }
        $this->dataToRender['cartTotal'] = $cartTotal;
        echo $this->view->render('checkout', $this->dataToRender);

    }

    protected function placeorderAction(): void
    {
        $this->checkAccess();
        $cart = new Cart();
        $cartItems = $cart->findAllByUserIdJoinWithProducts($_SESSION['user']['id']);
        if (!empty($cartItems)) {
            $order = new Orders();
            $orderData[Orders::DB_TABLE_FIELD_TOTALAMOUNT] = htmlentities($_POST['totalAmount']);
            ;
            $orderData[Orders::DB_TABLE_FIELD_USERID] = $_SESSION['user']['id'];
            $result = $order->insert($orderData);
            if ($result) {
                foreach ($cartItems as $item) {
                    $orderItem = new OrderItems;
                    $orderItemData[OrderItems::DB_TABLE_FIELD_ORDERID] = $_SESSION['order_id'];
                    $orderItemData[OrderItems::DB_TABLE_FIELD_PRODUCTID] = htmlentities($item['product_id']);
                    $orderItemData[OrderItems::DB_TABLE_FIELD_QUANTITY] = htmlentities($item['quantity']);
                    $orderItemData[OrderItems::DB_TABLE_FIELD_TOTALPRICE] = htmlentities($item['total_price']);
                    if ($orderItem->insert($orderItemData)) {
                        var_dump($item["id"]);
                        $deleteResult = $cart->deleteById($item['id']);
                        if ($deleteResult) {
                            echo "Cart item deleted successfully";
                        } else {
                            echo "Cart item deletion failed";
                        }
                    }

                }
                echo $this->view->render('thankyouPage', $this->dataToRender);

            }

        } else {
            $this->dataToRender['error'] = "Something went wrong upon checkout. Please try again.";
            header("Location:" . BASE_URL . "checkout");
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