<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(); ?>
<?= Html::a("Оновити", ['pjax/count', 'counter' => $counter], ['class' => 'btn btn-lg btn-primary']) ?>
    <h1>Лічильник: <?= $counter ?></h1>
<?php Pjax::end(); ?>