<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $descriprion
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     * @inheritdoc$primaryKey
     */
    public static function primaryKey()
    {
        return ["id"];
    }
    public function rules()
    {
        return [
            [['id', 'title', 'descriprion'], 'required'],
            [['id'], 'integer'],
            [['descriprion'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'descriprion' => 'Descriprion',
        ];
    }
}
