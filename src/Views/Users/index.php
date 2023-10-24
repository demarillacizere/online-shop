<div class="offset-2 col-6">
    <?php
    if(isset($data->error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $data->error?>
        </div>
        <?php
    }
    ?>
    <h1 class="mb-5">Create your account</h1>
    <form action="<?php echo BASE_URL.'register'?>" method="post">
         <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="full_name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
    <div class="mt-3">Have an account already? <a href="<?php echo BASE_URL.'login'?>">Log In</a></div>
</div>