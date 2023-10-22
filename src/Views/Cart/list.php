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
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // $('.btn-plus').on('click', function() {
        //     var input = $(this).closest('.input-group').find('input');
        //     var newValue = parseInt(input.val()) + 1;
        //     input.val(newValue);
        //     updateTotal(this, newValue);
        // });

        // $('.btn-minus').on('click', function() {
        //     var input = $(this).closest('.input-group').find('input');
        //     var newValue = parseInt(input.val()) - 1;
        //     if (newValue >= 0) {
        //         input.val(newValue);
        //         updateTotal(this, newValue);
        //     }
        // });

        // function updateTotal(button, newValue) {
        //     var row = $(button).closest('tr');
        //     var price = parseFloat(row.find('.price').data('price'));
        //     var newTotal = price * newValue;
        //     row.find('.total').text('$' + newTotal);
        //     // You can also make an AJAX request to update the cart in the database here.
        // }

        $('.btn-plus, .btn-minus').on('click', function () {
            var input = $(this).closest('.input-group').find('input');
            var newValue = parseInt(input.val()) + (this.classList.contains('btn-plus') ? 1 : -1);

            // Send the update to the server
            var productID = $(this).closest('tr').data('product-id');
            var price = parseFloat($(this).closest('tr').find('.price').data('price'));
            var newTotal = price * newValue;
            console.log(productID, newValue, newTotal);
            updateCart(productID, newValue, newTotal);
        });

        function updateCart(productID, newQuantity, newTotal) {
            // Store a reference to the row that triggered the update
            var row = $('tr[data-product-id="' + productID + '"]');

            $.ajax({
                type: 'PUT',
                url: '/online-shop/cart/update/' + productID, // Corrected URL
                data: {
                    newQuantity: newQuantity,
                    newTotal: newTotal
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        // Update the total on the correct row
                        row.find('.total').text('$' + newTotal);
                    } else {
                        console.log("There was an error");
                    }
                }
            });
        }

    });
</script>