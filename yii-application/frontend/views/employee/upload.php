<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'imageFile')->fileInput() ?>

<button style="background: lightgreen; border-radius: 20px;border:0; width: 100px;height: 50px; margin:10px">Save</button>

<?php ActiveForm::end() ?>
