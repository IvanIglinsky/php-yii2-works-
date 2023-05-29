<?php
use yii\helpers\Html;

$this->title = 'Org Chart';
$this->params['breadcrumbs'][] = $this->title;
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
    .google-visualization-orgchart-node-medium{
        background: cornflowerblue;
        border: none;
    }

</style>
<div id="chart_div"></div>

<?php
$js_data = [];
foreach ($departments as $department) {
    $js_data[$department['id']] = [
        'name' => Html::encode($department['name']),
        'type_id' => Html::encode($department['type_id']),
        'parent_id' => Html::encode($department['parent_id']),
    ];
}

$nodes = [];
foreach ($js_data as $id => $data) {
    $name = $data['name'];
    $type_id = $data['type_id'];
    $parent_id = $data['parent_id'];
    if ($parent_id) {
        $parent = $js_data[$parent_id]['name'];
        $nodes[] = [$name, $parent];
    } else {
        $nodes[] = [$name, ''];
    }
}

$js = "
    google.charts.load('current', {packages:['orgchart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        
        data.addColumn('string', 'Name');    
        data.addColumn('string', 'Parent');
        data.addRows(" . json_encode($nodes) . ");
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        
        chart.draw(data, {allowHtml:true, verticalLayout:true});
        
    }
";
$this->registerJs($js);
?>
