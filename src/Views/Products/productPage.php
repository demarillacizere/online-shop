<section class="pb-2">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo $data->product['image'] ?>"
                    alt="..." /></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">
                    <?php echo $data->product['name'] ?>
                </h1>
                <div class="fs-5 mb-5">
                    <span class="text-decoration-line-through">$
                        <?php echo $data->product['price'] * 1.1 ?>
                    </span>&ThickSpace;
                    <span>$
                        <?php echo $data->product['price'] ?>
                    </span>
                </div>
                <p class="lead">
                    <?php echo $data->product['description'] ?>
                </p>
                <div class="d-flex">
                    <form action="/online-shop/product/<?php echo $data->product['id'] ?>" method="post">
                        <p class="" style="color:red;">
                            <?php echo $data->product['quantity'] . " left in stock." ?>
                        </p>
                        <input class="form-control text-center" name="quantity" id="inputQuantity" type="number"
                            value="1" min="1" max=<?php echo $data->product['quantity'] ?> style="max-width:4rem" />
                        <input type="hidden" value="<?php echo $data->product['id'] ?>" name="productId">
                        <input type="hidden" value="<?php echo $data->product['price'] ?>" name="productPrice">
                        <button class="btn btn-outline-dark flex-shrink-0 mt-2" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function incrementQuantity() {
        var inputQuantity = document.getElementById('inputQuantity');
        inputQuantity.stepUp();
    }

    function decrementQuantity() {
        var inputQuantity = document.getElementById('inputQuantity');
        inputQuantity.stepDown();
    }
</script>