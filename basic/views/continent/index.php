<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <?php
    foreach ($continents as $continentItem):?>
        <div class="card  m-3 p-0 border-primary" style="width: 370px">
        <a href="<?= Url::to(['continent/view', 'continent_id' => $continentItem['continent_id']]); ?>"
           class="list-group-item">
                <h5 class="card-header bg-primary text-white"><?= Html::encode($continentItem['name']) ?></h5>
                <div class="card-body">
                    <?= Html::img('@web/images/continents/' . Html::encode($continentItem['code']) . '.png', ['alt' => Html::encode($continentItem['name']),'class'=>"img-thumbnail"])  ?>
                    <p class="card-text"><?= Html::encode($continentItem['description']) ?></p>
                </div>
        </a>
        </div>
    <?php endforeach; ?>
</div>
