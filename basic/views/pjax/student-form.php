<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'Check Name';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(['id' => 'check-name-form']); ?>

<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true]
]); ?>

<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
<?php ActiveForm::end(); ?>
    <div id="result-container">
            <?php  print_r($lang);?>
    </div>

<?php Pjax::end(); ?>