<div class="col-12 col-md-5 col-lg-4 py-8 py-md-11">

    <!-- Heading -->
    <h1 class="font-bold text-center">Sign in</h1>

    <!-- Text -->
    <p class="text-center mb-6">Welcome to the official Chat web-client.</p>
    
    <!-- FIXME: give fields their respective default values -->
    <!-- Form -->
    <?php echo $this->Form->create(false, array('url' => '/login')) ?>
        <!-- Email -->
        <div class="form-group">
            <label for="email" class="sr-only">Email Address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="<?php echo !empty($this->request->data['email']); ?>">
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
        </div>

        <div class="form-group d-flex justify-content-between">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked="" id="checkbox-remember">
                <label class="custom-control-label" for="checkbox-remember">Remember me</label>
            </div>
            <a href="./password-reset.html">Reset password</a>
        </div>

        <!-- Submit -->
    <?php echo $this->Form->end(array('class' => 'btn btn-block btn-primary mb-5', 'label' => 'Sign In')); ?>

    <!-- Text -->
    <p class="text-center">
        Don't have an account yet <a href="./signup">Sign up</a>.
    </p>

</div>