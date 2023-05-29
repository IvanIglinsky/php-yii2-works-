<?php
namespace common\rbac;

use yii\rbac\Rule;
use frontend\models\Employee;

/**
 * Checks if authorID matches user passed via params
 */
class OwnProfileRule extends Rule
{
    public $name = 'OwnProfileRule';

    /**
     * @param string|int $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return bool a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        return isset($params['employee']) ? $params['employee']->id == $user : false;
    }
}