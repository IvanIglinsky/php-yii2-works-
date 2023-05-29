<?php

namespace app\controllers;

use app\models\Continent;
use app\models\Country;
use app\models\CountrySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\bootstrap5\LinkPager;

class ContinentController extends Controller
{
    public function actionIndex()
    {
        $continents=Continent::find()->asArray()->all();
        return $this->render('index',['continents'=>$continents]);
    }

    public function actionView($continent_id)
    {
        $continent = Continent::findOne($continent_id);
        $countriesDataProvider = new ActiveDataProvider([
            'query' => Country::find()->where(['continent_id' => $continent_id]),
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);

       return $this->render('view', compact('continent', 'countriesDataProvider'));
    }
}