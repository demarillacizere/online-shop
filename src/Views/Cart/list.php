<?php
if (count($data->items) > 0) { ?>
    <table class="table table-bordered text-center mb-0">
        <thead class="bg-grey text-dark">
            <tr>
                <th>Products</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Remove</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            <?php
            foreach ($data->items as $product) {
                include __DIR__ . '/../templates/cartViewOfProduct.php';
            }
            ?>

        </tbody>
    </table>
    <div class="row mt-5">
        <div class="col-12 text-end">
            <a class="btn btn-outline-success mt-auto" href="/online-shop/checkout">Checkout</a>
        </div>
    </div>
    <?php
} else { ?>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h2>Cart is empty</h2>
        </div>
    </div>
    <?php
}