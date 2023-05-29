<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<?php Pjax::begin(); ?>
<?php $form = ActiveForm::begin([
  'options' => ['data' => ['pjax' => true]],
]); ?>

<?= $form->field($model, 'first_name')->textInput() ?>
<?= $form->field($model, 'last_name')->textInput() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('OK', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
<?= $fullName; ?>
<?php Pjax::end(); ?>
