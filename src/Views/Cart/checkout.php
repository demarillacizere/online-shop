<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?php echo BASE_URL ?>">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
<div class="container-fluid pt-5 ">
    <div class="row px-xl-5 justify-content-center gap-5">
        <div class="col-lg-3">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                <div>
                    <div class=" form-group">
                        <label>Full Name</label>
                        <input class="form-control" type="text" value="<?php echo $_SESSION['user']['full_name'] ?>">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" value="<?php echo $_SESSION['user']['email'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input class="form-control" type="text" placeholder="0712338492">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" value="<?php echo $_SESSION['user']['address'] ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Products</h5>
                    <?php foreach ($data->items as $product) { ?>
                        <div class="d-flex justify-content-between">
                            <p>
                                <?php echo $product['name']; ?>
                            </p>
                            <p>$
                                <?php echo $product['total_price']; ?>
                            </p>
                        </div>
                    <?php }
                    ; ?>
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">$
                            <?php echo $data->cartTotal; ?>
                        </h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">$10</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">$
                            <?php echo $data->cartTotal + 10; ?>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Payment</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo BASE_URL . 'placeOrder' ?>" method="post">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal" required
                                    selected>
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="mobilemoney">
                                <label class="custom-control-label" for="mobilemoney">Mobile Money</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">

                    <input type="hidden" name="totalAmount" value="<?php echo $data->cartTotal + 10; ?>">
                    <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" type="submit">Place
                        Order</button>


                </div>
                </form>
            </div>
        </div>
    </div>