<?php


namespace common\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $name
 * @property int $department_type_id
 * @property int|null $parent_id
 *
 * @property DepartmentType $departmentType
 * @property Department $parent
 * @property Department[] $departments
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $children;
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'department_type_id'], 'required'],
            [['department_type_id', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['children'],'string'],
            [['department_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DepartmentType::className(), 'targetAttribute' => ['department_type_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'department_type_id' => 'Department Type ID',
            'parent_id' => 'Parent ID',
            'children'=>'Children',
        ];
    }


}
