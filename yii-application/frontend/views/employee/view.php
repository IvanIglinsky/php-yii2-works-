<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employee */

$this->title = $model->lastname;
$this->params['breadcrumbs'][] = ['label' => 'Працівники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">




    <div class="row justify-content-center">
        <div class="col-7">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-7 col-sm-3">
            <?= Html::img($model->getImage(), ['alt' => 'My logo', 'width' => '100%', 'class' => 'border']) ?>
            <?= Html::a('Редагувати зображення', ['update-image', 'id' => $model->id], ['class' => 'btn btn-primary mt-2']) ?>
        </div>

        <div class="col-7 col-sm-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'firstname',
                    'lastname',
                    'email:email',
                    'department.name',
                ],
            ]) ?>
            <?php if (Yii::$app->user->can('employeeUpdate', ['employee' => $model])): ?>
                <p>
                    <?= Html::a('Редагувати профіль', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </p>
            <?php endif; ?>
        </div>
    </div>


</div>

