<div class="offset-2 col-6">
    <?php
    if (isset($data->error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $data->error ?>
        </div>
        <?php
    }
    ?>
    <?php
    if (isset($data->success)) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $data->success ?>
    </div>
        <?php
    }
    ?>
</div>
<div class="col-12">
    <h3 class="mb-5 text-center"><?php echo $data->categoryName ?></h3>

<?php
if(count($data->products) > 0) {
    ?>
    <div class="container">
    <div class="row">
    <?php
    foreach ($data->products as $product) {
        include __DIR__ . "/../templates/productCart.php";
    }
}
?></div>
    </div>
</div>