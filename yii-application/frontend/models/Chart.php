<?php
namespace frontend\models;

use yii\base\Model;



class Chart extends Model
{
    public static function tableName()
    {
        return 'department';
    }

    public static function getChartData()
    {
        $data = [];
        $charts = Chart::find()->all();

        foreach ($charts as $chart) {
            $data[] = [
                'label' => $chart->name,
                'parent_id' => $chart->parent_id,
                'type_id'=>$chart->type_id
            ];
        }

        return json_encode($data);
    }
}