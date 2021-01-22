<?php
/** @var \app\models\Contact $model */

use app\core\forms\TextareaField;

$model = $this->model;
?>

<h2>Contact</h2>

<?php $form = \app\core\forms\Form::begin('/contact', 'post'); ?>

<?= $form->field($model, 'subject') ?>

<?= $form->field($model, 'email') ?>

<?= new TextareaField($model, 'body') ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php \app\core\forms\Form::end(); ?>
