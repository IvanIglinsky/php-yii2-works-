<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<a href="<?= Url::to(['country/view', 'code' => $model->code]) ?>" class="list-group-item list-group-item-action">
    <?= Html::img('@web/images/countries/png100px/' . strtolower($model['code']) . '.png', ['alt' => $model['name']]) ?>
    <?= Html::encode($model->name) ?>
</a>
