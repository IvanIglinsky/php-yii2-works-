<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

 <?= $form->field($model, 'name')->label('Ваше ім’я') ?>
<?= $form->field($model, 'email')->label('Ваша адреса електронної пошти') ?>


    <div class="form-group">
        <?= Html::submitButton('Надіслати', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>