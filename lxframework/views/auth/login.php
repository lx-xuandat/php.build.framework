<?php

use app\core\forms\Field;

$model = $this->model;
?>

<h2>Login</h2>

<?php $form = \app\core\forms\Form::begin("/login", "post") ?>

<div class="form-group">
    <?php $form->field($model, 'email', Field::TYPE_EMAIL); ?>
</div>

<div class="form-group">
    <?php $form->field($model, 'password', Field::TYPE_PASSWORD); ?>
</div>

<button type="submit" class="btn btn-primary">Login</button>

<?php \app\core\forms\Form::end() ?>
