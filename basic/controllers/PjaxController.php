<?php


namespace app\controllers;


use app\models\City;
use app\models\Continent;
use app\models\Country;
use app\models\JsonFile;
use app\models\Region;
use app\models\StudentForm;
use app\models\WorldForm;
use Yii;
use yii\web\Controller;

class PjaxController extends Controller
{
    public function actionGetServerTime()
    {
        return $this->render('get-server-time', ['time' => date("h:i:s")]);
    }

    public function actionGetServerTimeAuto()
    {
        return $this->render('get-server-time-auto', ['time' => date("h:i:s")]);
    }

    public function actionCount($counter = 0)
    {
        $counter++;
        return $this->render('count', compact('counter'));
    }

    public function actionGetFullName()
    {

        $model = new StudentForm();
        $fullName = $model->first_name . " " . $model->last_name;
        if (Yii::$app->request->isPjax) {
            $model->load(Yii::$app->request->post());
            $fullName = $model->first_name . " " . $model->last_name;
            return $this->render('get-full-name', compact('model', 'fullName'));
        }
        return $this->render('get-full-name', compact('model', 'fullName'));
    }

    public function actionStudentForm()
    {
        $model = new StudentForm();
        $lang = '';
        if(Yii::$app->request->isPjax) {
            $name = Yii::$app->getRequest()->post();
            $file = file_get_contents('../StudentLang.json');
            $users = json_decode($file, true);
            foreach ($users as $user) {
                if ($user['name'] == $name["StudentForm"]["first_name"]) {
                    $lang = implode(', ', $user['languages']);
                    break;
                } else {
                    $lang = "Not Found";
                }
            }
        }
            return $this->render('student-form', ['model' => $model, 'lang' => $lang]);
    }

    public function actionWorldForm()
    {

        $model = new WorldForm();
        $continents = Continent::find()->asArray()->all();
        $data['continents'] = $continents;

        $continent = null;
        $country = null;
        $region = null;
        $city = null;
        $cities=null;

        if (Yii::$app->request->isPjax) {

            $model->load(Yii::$app->request->post());
            if ($model->continent_id > 0) {
                $data['continent'] = Continent::find()->where(['continent_id' => $model->continent_id])->one();
                $data['countries'] = Country::find()->where(['continent_id' => $model->continent_id])->all();

            }
            if ($model->country_id > 0) {
                $data['country'] = Country::find()->where(['country_id' => $model->country_id])->one();
                $data['regions'] = Region::find()
                    ->select('region.*, region_language.name_language as name_language')
                    ->leftJoin('region_language', '`region_language`.`region_id`=`region`.`region_id`')
                    ->where(['region_language.language' => 'en', 'region.country_id' => $model->country_id])
                    ->asArray()
                    ->all();

            }
            if ($model->region_id > 0) {
                $data['region'] = Region::find()
                    ->select('region.*, region_language.name_language as name_language')
                    ->leftJoin('region_language', '`region_language`.`region_id`=`region`.`region_id`')
                    ->where(['region_language.language' => 'en', 'region.region_id' => $model->region_id])
                    ->one();
                $data['cities'] = City::find()
                    ->select('city.*, city_language.name_language as name_language')
                    ->leftJoin('city_language', '`city_language`.`city_id`=`city`.`city_id`')
                    ->where(['city_language.language' => 'en', 'city.region_id' => $model->region_id])
                    ->asArray()
                    ->all();

            }
            if ($model->city_id > 0) {
                $data['city'] = City::find()
                    ->select('city.*, city_language.name_language as name_language')
                    ->leftJoin('city_language', '`city_language`.`city_id`=`city`.`city_id`')
                    ->where(['city_language.language' => 'en', 'city.city_id' => $model->city_id])
                    ->one();
            }
        }
        $data['model'] = $model;
        return $this->render('world-form', $data);
    }

}
