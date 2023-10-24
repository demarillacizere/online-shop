<?php
?>

<!-- Navigation-->
<div class="row align-items-center py-3 px-xl-5">
    <div class="col-lg-3 d-none d-lg-block">
        <a href="/online-shop/" class="text-decoration-none">
            <h1 class="m-0 display-5 font-weight-semi-bold"><span
                    class="text-primary font-weight-bold border px-3 mr-1">Demy's</span>Shop</h1>
        </a>
    </div>
    <div class="col-lg-6 col-6 text-left">
        <form action="">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for products">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-3 col-6 text-right">
        <a href="/online-shop/cart" class="btn border">Cart
            <i class="fas fa-shopping-cart text-primary"></i>
            <span class="badge text-dark ">
                <?php echo $data->cartQuantity ?>
            </span>
        </a>
        <?php if (!empty($_SESSION['user'])) {
            echo '<a class="btn border" href="/online-shop/logout">Log Out</a>';
        } else {
            echo '<a class="btn border" href="/online-shop/login">Log in</a>';
            echo '<a class="btn border" href="/online-shop/register">Register</a>';
        }
        ?>
    </div>
</div>
