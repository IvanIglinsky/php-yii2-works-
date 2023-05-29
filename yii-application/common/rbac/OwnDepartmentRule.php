<?php

namespace common\rbac;

use common\models\User;
use yii\rbac\Rule;

class OwnDepartmentRule extends  Rule
{
    public $name = 'OwnDepartmentRule';
public function execute($user, $item, $params)
{
    $currentUser=User::findOne($user);
    return isset($params['employee']) ? $params['employee']->department_id == $currentUser->department_id : false;

}
}