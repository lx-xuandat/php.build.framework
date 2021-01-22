<?php use app\core\forms\InputField;
use app\core\forms\Form;

$model = $this->model;
?>

<h2>Register</h2>
<?php $form = Form::begin('/register', 'post'); ?>

<div class="form-row">
    <div class="form-group col">
        <?= $form->field($model, 'firstname') ?>
    </div>
    <div class="form-group col">
        <?= $form->field($model, 'lastname') ?>
    </div>
</div>

<div class="form-group">
    <?= $form->field($model, 'email')->email() ?>
</div>

<div class="form-group">
    <?= $form->field($model, 'password')->password() ?>
</div>

<div class="form-group">
    <?= $form->field($model, 'confirmPassword')->password() ?>
</div>

<button type="submit" class="btn btn-primary">Register</button>
<?php Form::end(); ?>
