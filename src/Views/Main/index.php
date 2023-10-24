<h3 class="text-center mb-5">Today's Hot Deals</h3>
<div class="container">
    <div class="row">
    <?php
foreach ($data->products as $product) {
    include __DIR__ . '/../templates/productCart.php';
}?>
    </div>

</div>


