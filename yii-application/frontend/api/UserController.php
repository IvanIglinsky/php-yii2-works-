<?php

namespace frontend\api;

use app\api\models\Signup;
use app\api\models\Login;
use app\api\models\Response;
use common\models\LoginForm;
use common\models\User;
use Yii;

use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;
use yii\web\ForbiddenHttpException;

class UserController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                // Реалізуйте свою логіку аутентифікації тут
            },
        ];
        $behaviors['authenticator']['only'] = [
            'create',
            'update',
            'delete',
        ];
        return $behaviors;
    }

    public function actionSignup()
    {
        $model = new Signup();
        if ($model->load(Yii::$app->request->post(),"") && $model->signup()) {
            $user = User::findByUsername($model->username);
            return $user;
        }
        throw new ForbiddenHttpException();
    }

    public function actionLogin()
    {
        $model = new Login();
        if($model->load(Yii::$app->request->post(),"") &&  $model->validate()){
            $user=User::findByUsername($model->username);
            if($user && $user->validatePassword($model->password)){
                Yii::$app->user->login($user,0);
                $user->generateAccessToken();
                $user->save();
                $response=new Response;
                $response->access_token=$user->access_token;
                return $response;
            }
        }
        throw new ForbiddenHttpException();
    }
    public function checkAccess($action,$model=null,$params=[]){
        if(in_array($action,['update','delete'])
            && $model->user_id!==Yii::$app->user->getId()){
            throw new ForbiddenHttpException("You don`t have enough permissions");
        }
    }
}