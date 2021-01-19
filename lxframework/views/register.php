<?php
$model = $this->model;

?>

<h2>Register</h2>
<form action="/register" method="post">

    <div class="form-row">
        <div class="form-group col">
            <label for="firstname">First name</label>
            <input type="text" id="firstname" name="firstname" placeholder="Enter First name"
                   value="<?= $model->firstname ?>"
                   class="form-control <?php echo $model->hasError('firstname') ? ' is-invalid' : '' ?>">
            <small class="invalid-feedback">
                <?php echo $model->getFirstError('firstname') ?>
            </small>
        </div>

        <div class="form-group col">
            <label for="lastname">Last name</label>
            <input type="text" id="lastname" name="lastname" placeholder="Enter Last name"
                   value="<?= $model->lastname ?>"
                   class="form-control <?php echo $model->hasError('lastname') ? ' is-invalid' : '' ?>">
            <small class="invalid-feedback">
                <?php echo $model->getFirstError('lastname') ?>
            </small>
        </div>
    </div>

    <div class="form-group">
        <label for="email">Email address</label>
        <input type="text" id="email" name="email" placeholder="Enter email"
               value="<?= $model->email ?>"
               class="form-control <?php echo $model->hasError('email') ? ' is-invalid' : '' ?>">
        <small class="invalid-feedback">
            <?php echo $model->getFirstError('email') ?>
        </small>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Password"
               class="form-control <?php echo $model->hasError('password') ? ' is-invalid' : '' ?>">
        <small class="invalid-feedback">
            <?php echo $model->getFirstError('password') ?>
        </small>
    </div>

    <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirmPassword" placeholder="Confirm Password"
               class="form-control <?php echo $model->hasError('confirmPassword') ? ' is-invalid' : '' ?>">
        <small class="invalid-feedback">
            <?php echo $model->getFirstError('confirmPassword') ?>
        </small>
    </div>

    <button type="submit" class="btn btn-primary">Register</button>
</form>
