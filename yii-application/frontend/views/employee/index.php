<?php

use frontend\models\Employee;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var frontend\models\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="employee-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'username',
            'firstname',
            'lastname',
            'email',
            'department_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employee $model) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
