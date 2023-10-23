<?php
?>

<!-- Navigation-->
<div class="row align-items-center py-3 px-xl-5">
    <div class="col-lg-3 d-none d-lg-block">
        <a href="" class="text-decoration-none">
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
        <a href="" class="btn border">
            WishList
            <i class="fas fa-heart text-primary"></i>
            <span class="badge text-dark">0</span>
        </a>
        <a href="/online-shop/cart" class="btn border">Cart
            <i class="fas fa-shopping-cart text-primary"></i>
            <span class="badge text-dark ">
                <?php echo $data->cartQuantity ?>
            </span>
        </a>
    </div>
</div>

<!-- Navbar Start -->
<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">
                <?php if (count($data->categories) > 0) { ?>
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <?php foreach ($data->categories as $category) { ?>
                            <a href="<?php echo BASE_URL . 'category/' . $category['id']; ?>" class="nav-item nav-link">
                                <?php echo $category['name']; ?>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </nav>

        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">Demy's</span>Shop</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/online-shop/" class="nav-item nav-link active">Home</a>
                        <a href="shop.html" class="nav-item nav-link">Shop</a>
                        <a href="/online-shop/about" class="nav-item nav-link">Shop Detail</a>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        <?php if (!empty($_SESSION['user'])) {
                            echo '<a class="nav-item nav-link btn border" href="/online-shop/logout">Log Out</a>';
                        } else {
                            echo '<a class="nav-item nav-link btn border" href="/online-shop/login">Log in</a>';
                            echo '<a class="nav-item nav-link btn border" href="/online-shop/register">Create account</a>';
                        }
                        ?>
                    </div>
                </div>
            </nav>

        </div>
    </div>
</div>