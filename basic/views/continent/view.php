<?php
use yii\helpers\Html;
use app\controllers\ContinentController;
use yii\widgets\ListView;
use yii\bootstrap5\LinkPager;
$this->title=$continent->name;

$this->params['breadcrumbs'][]=['label'=>'Continents','url'=>['continent/index']];
$this->params['breadcrumbs'][]=['label'=>$continent['name'],'url'=>['continent/view','continent_id'=>$continent['continent_id']]];
?>
<section id="continent-view">
    <div class="container">
        <h1><?= Html::encode($this->title)?></h1>
        <p><?= Html::encode($continent->description)?></p>
        <?=ListView::widget([
                'dataProvider'=>$countriesDataProvider ,
                'itemView'=>'_country',
                'layout'=>"{items}\n{summary}\n{pager}",
                'options'=>[
                        'class'=>'list-group'
                ],
                'itemOptions'=>[
                        'tag'=>false,
                ],

        ]);?>


    </div>
</section>
