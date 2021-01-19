<?php use app\core\forms\Field;
use app\core\forms\Form;

$model = $this->model;
?>

<h2>Register</h2>
<?php $form = Form::begin('', 'post'); ?>

<div class="form-row">
    <div class="form-group col">
        <?php $form->field($model, 'firstname') ?>
    </div>
    <div class="form-group col">
        <?php $form->field($model, 'lastname') ?>
    </div>
</div>

<div class="form-group">
    <?php $form->field($model, 'email', Field::TYPE_EMAIL) ?>
</div>

<div class="form-group">
    <?php $form->field($model, 'password', Field::TYPE_PASSWORD) ?>
</div>

<div class="form-group">
    <?php $form->field($model, 'confirmPassword', Field::TYPE_PASSWORD) ?>
</div>

<button type="submit" class="btn btn-primary">Register</button>
<?php Form::end(); ?>
