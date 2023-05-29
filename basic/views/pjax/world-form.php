<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
<?php Pjax::begin([
    'id' => 'world-form-container'
]); ?>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">
                <?php $form = ActiveForm::begin([
                    'options' => ['data' => ['pjax' => true]],
                    'id' => 'world-form'
                ]); ?>
               <?php if (isset($continents) && !empty($continents)): ?>
                <?= $form->field($model, 'continent_id')->dropDownList(ArrayHelper::map($continents, 'continent_id', 'name'), [
                    'id' => 'field-continent-id',
                    'prompt' => '--Select a continent',
                    'onchange' => '
                    $("#field-country-id").val("");
                    $("#field-region-id").val("");
                    $("#field-city-id").val("");
                    $("#world-form").submit();'
                ]) ?>
                <?php endif; ?>
                <?php if (isset($countries) && !empty($countries)): ?>
                    <?= $form->field($model, 'country_id')->dropDownList(ArrayHelper::map($countries, 'country_id', 'name'), [
                        'id' => 'field-country-id',
                        'prompt' => '-- Select a country --',
                        'onchange' => '
                    $("#field-region-id").val("");
                    $("#field-city-id").val("");
                    $("#world-form").submit();'
                    ]) ?>
                <?php endif; ?>
                <?php if (isset($regions) && !empty($regions)): ?>
                    <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map($regions, 'region_id', 'name_language'), [
                        'id' => 'field-region-id',
                        'prompt' => '-- Select a region --',
                        'onchange' => '
                    $("#field-city-id").val("");
                    $("#world-form").submit();'
                    ]) ?>
                <?php endif; ?>
                <?php if (isset($cities) && !empty($cities)): ?>
                    <?= $form->field($model, 'city_id')->dropDownList(ArrayHelper::map($cities, 'city_id', 'name_language'), [
                        'id' => 'field-city-id',
                        'prompt' => '-- Select a city --',
                        'onchange' => '$("#world-form").submit();'
                    ]) ?>
                <?php endif; ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-12 col-md-6 col-lg-8">
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2">Your place</th>
                    </tr>
                    <?php if (!empty($continent)) {
                        if ($continent->name): ?>
                            <tr>
                                <th>Continent</th>
                                <td><?= $continent->name ?></td>
                            </tr>
                        <?php endif;
                    } ?>
                    <?php if (!empty($country)) {
                        if ($country->name): ?>
                            <tr>
                                <th>Country</th>
                                <td><?= $country->name ?></td>
                            </tr>
                        <?php endif;
                    } ?>
                    <?php if (!empty($region)) {
                        if ($region->name_language): ?>
                            <tr>
                                <th>Region</th>
                                <td><?= $region->name_language ?></td>
                            </tr>
                        <?php endif;
                    } ?>
                    <?php if (!empty($city)) {
                        if ($city->name_language): ?>
                            <tr>
                                <th>City</th>
                                <td><?= $city->name_language ?></td>
                            </tr>
                        <?php endif;
                    } ?>
                </table>
            </div>
        </div>
    </div>

<?php Pjax::end();
