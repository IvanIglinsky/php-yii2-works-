<?php

use yii\helpers\Html;

$this->title = $country->name;

$this->params['breadcrumbs'][] = ['label' => 'Continents', 'url' => ['continent/index']];
$this->params['breadcrumbs'][] = ['label' => 'Country', 'url' => ['continent/view', 'continent_id' => $country['continent_id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<script async
        src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap">
</script>
<script>
    function initMap() {

        let lat=JSON.parse("<?php echo $country['coords'];?>")[0]
        let lng=JSON.parse("<?php echo $country['coords'];?>")[1]
        console.log(lng)
        let myLatLng = {lat: lat, lng: lng};
        let map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: myLatLng
        });
        let marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'My point'
        });
    }
</script>
<body onload="initMap()">
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
<table class="table table-striped" style="margin-right: 10px; width: 48%;">
    <tr>
        <th>Official Name</th>
        <td><?= Html::encode($country->name) ?></td>
    </tr>
    <tr>
        <th>Image</th>
        <td> <?= Html::img('@web/images/countries/png250px/' . strtolower(Html::encode($country->code)) . '.png', ['alt' => Html::encode($country->name), 'class' => "img-thumbnail"]) ?>
        </td>
    </tr>
    <tr>
        <th>Capital</th>
        <td><?= Html::encode($country->capital) ?></td>
    </tr>
    <tr>
        <th>Area</th>
        <td><?= Html::encode($country->area) ?></td>
    </tr>
    <tr>
        <th>Currency</th>
        <td><?= Html::encode($country->currency) ?></td>
    </tr>
</table>
<div id="map" style="width: 48%; height: 500px;"></div>
</div>
</body>
