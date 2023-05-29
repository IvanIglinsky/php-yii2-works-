<?php
use yii\widgets\Pjax;
    Pjax::begin(['id' => 'time']);
    echo '<h1>' . $time . '</h1>';
    Pjax::end();
?>

<div id="time"></div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    // Оновлення блоку #time кожні 5 секунд
    setInterval(function() {
        $.pjax.reload({container: '#time', timeout: false});
    }, 1000);
</script>
<?php Pjax::begin(); ?>
<?php Pjax::end(); ?>