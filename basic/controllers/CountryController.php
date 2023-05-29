<?php


namespace app\controllers;

use app\models\Continent;
use app\models\CountrySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionView($code)
    {
        $country = Country::findOne(['code'=>$code]);

//        $countrySearchModel = new CountrySearch();
////        $countryDataProvider = $countrySearchModel->search($this->request->queryParams);
//        $countriesDataProvider = new ActiveDataProvider([
//            'query' => Country::find()->where(['continent_id' => $continent_id]),
//            'pagination' => [
//                'pageSize' => 20,
//            ]
//        ]);

        return $this->render('view', compact('country'));
    }

}