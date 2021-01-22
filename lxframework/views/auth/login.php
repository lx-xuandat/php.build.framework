<?php

use app\core\forms\Form;

$model = $this->model;
?>

<h2>Login</h2>

<?php $form = Form::begin("/login", "post") ?>

<div class="form-group">
    <?= $form->field($model, 'email')->email(); ?>
</div>

<div class="form-group">
    <?= $form->field($model, 'password')->password(); ?>
</div>

<button type="submit" class="btn btn-primary">Login</button>

<?php Form::end() ?>
