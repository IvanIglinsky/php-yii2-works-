<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(); ?>
<?= Html::a("Оновити", ['pjax/get-server-time'], ['class' => 'btn btn-lg btn-primary']) ?>
    <h1>Зараз: <?= $time ?></h1>
<?php Pjax::end(); ?>