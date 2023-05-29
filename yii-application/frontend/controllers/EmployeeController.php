<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\Employee;
use frontend\models\EmployeeSearch;
use frontend\models\EmployeeUploadForm;
use frontend\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view', 'create', 'update'],
                            'roles' => ['Employee'],
                        ],
                        [
                            'allow' => true,
                            'actions' => ['delete'],
                            'roles' => ['Admin'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Employee models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (!Yii::$app->user->can('employeeUpdate', ['employee' => $model])) {
            throw new ForbiddenHttpException("Access Denied");
        }


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateImage($id)
    {
        $employee = $this->findModel($id);
        if (!Yii::$app->user->can('employeeUpdate', ['employee' => $employee])) {
            throw new ForbiddenHttpException("Access Denied");
        }

        $model = new EmployeeUploadForm();

        if (Yii::$app->request->isPost) {
            if ($model->saveImage($id)) {
                return $this->redirect(['employee/view', 'id' => $id]);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }


    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMyProfile()
    {
        $model = Employee::findOne(Yii::$app->user->getId());
        return $this->render('view', [
            'model' => $model,
        ]);
    }


    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = User::findByUsername($model->username);
            if ($user !== null) {
                return $user;
            } else {
                return 'User not found.';
            }
        }
        throw new ForbiddenHttpException();
    }
}
