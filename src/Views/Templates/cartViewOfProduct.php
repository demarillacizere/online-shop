<tr data-product-id="<?php echo $product['id']; ?>">
    <td class="align-middle d-none">
        <?php echo $product['id']; ?>
    </td>
    <td class="">
        <img src="<?php echo $product['image']; ?>" alt="" style="width: 50px;">
        <?php echo $product['name']; ?>
    </td>
    <td class="align-middle price" data-price="<?php echo $product['price']; ?>">
        $
        <?php echo $product['price']; ?>
    </td>
    <td class="align-middle">
        <div class="input-group quantity mx-auto" style="width: 100px;">
            <div class="input-group-btn">
                <button class="btn btn-sm btn-primary btn-minus">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
            <input type="text" class="form-control form-control-sm bg-secondary text-center"
                value="<?php echo $product['order_quantity']; ?>">
            <div class="input-group-btn">
                <button class="btn btn-sm btn-primary btn-plus">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
    </td>
    <td class="align-middle total">
        <?php echo '$ ' . ($product['total_price']); ?>
    </td>
    <td class="align-middle">
        <button class="btn btn-sm btn-primary">
            <a class="btn btn-outline-danger mt-auto" href="<?php echo BASE_URL . 'cart/remove/' . $product['id']; ?>">
                <i class="fa fa-times"></i>
            </a>
        </button>
    </td>
</tr>