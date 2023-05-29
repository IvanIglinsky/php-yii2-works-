<?php

namespace frontend\models;

use common\models\Department;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string|null $first_name
 * @property string|null $last_name
 * @property int|null $department_id
 *
 * @property Department $department
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'department_id'], 'required'],
            [['department_id'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 50],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::class, 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'department_id' => 'Department',
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::class, ['id' => 'department_id']);
    }
    public function getImage()
    {
        if (empty($this->image) ||
            !is_file(Yii::getAlias("@frontend") . '/web/images/employee/' . $this->image)) {
            return '/images/employee/placeholder.png';
        }
        return '/images/employee/' . $this->image;
    }

}