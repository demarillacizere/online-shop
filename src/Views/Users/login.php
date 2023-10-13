<div class="offset-2 col-6">
    <?php
    if(isset($data->error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $data->error?>
        </div>
        <?php
    }
    ?>
    <?php
    if(isset($data->success)) { ?>
        <div class="alert alert-success" role="alert">
            <?php echo $data->success?>
        </div>
        <?php
    }
    ?>
    <form action="<?php echo BASE_URL.'login'?>" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Log in</button>
    </form>
    <div class="mt-3">Don't have an account yet? <a href="<?php echo BASE_URL.'register'?>">Register Here</a></div>
</div>