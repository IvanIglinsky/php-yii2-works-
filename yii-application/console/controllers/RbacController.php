<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // add "employee" role
        $employee = $auth->createRole('employee');
        $auth->add($employee);

        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $employee);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manager);
    }

    /**
     * @throws \Exception
     */
    public function actionAssignRoles()
    {
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');
        $employee = $auth->getRole('employee');
        $manager = $auth->getRole('manager');

        $auth->assign($admin, 1); //Jane -- Admin
        $auth->assign($manager, 2); //John -- Manager
        $auth->assign($employee, 3); //Alex -- Employee
        $auth->assign($employee, 4); //Peter -- Employee
    }

    public function actionUpdatePermissions()
    {
        $auth = Yii::$app->authManager;
        //employeeUpdate
        $employeeUpdate = $auth->createPermission('employeeUpdate');
        $auth->add($employeeUpdate);
        $rule = new \common\rbac\OwnProfileRule();
        $auth->add($rule);
// add the "updateOwnPost" permission and associate the rule with it.
        $employeeUpdateOwnProfile = $auth->createPermission('employeeUpdateOwnProfile');
        $employeeUpdateOwnProfile->ruleName = $rule->name;
        $auth->add($employeeUpdateOwnProfile);
        $auth->addChild($employeeUpdateOwnProfile, $employeeUpdate);
    }

    public function actionAssignPermissions()
    {
        $auth = Yii::$app->authManager;
        $employeeUpdate = $auth->getPermission('employeeUpdate');
        $employeeUpdateOwnProfile = $auth->getPermission('employeeUpdateOwnProfile');
        $admin = $auth->getRole('admin');
        $employee = $auth->getRole('employee');
        $auth->addChild($admin, $employeeUpdate);
        $auth->addChild($employee, $employeeUpdateOwnProfile);

    }
    public function actionUpdatePermissions2()
    {
        $auth = Yii::$app->authManager;
        //employeeUpdate
        $employeeUpdate = $auth->getPermission('employeeUpdate');
        $rule = new \common\rbac\OwnDepartmentRule();
        $auth->add($rule);

// add the "updateOwnPost" permission and associate the rule with it.
        $employeeUpdateOwnDepartment = $auth->createPermission('employeeUpdateOwnDepartment');
        $employeeUpdateOwnDepartment->ruleName = $rule->name;
        $auth->add($employeeUpdateOwnDepartment);

        $auth->addChild($employeeUpdateOwnDepartment, $employeeUpdate);
        $Manager=$auth->getRole("Manager");
        $auth->addChild($Manager,$employeeUpdateOwnDepartment);
    }
}