<?php


namespace app\models;


use yii\base\Model;

class StudentForm extends Model
{
    public string $first_name = "";
    public string $last_name = "";

    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => "First Name",
            'last_name' => "Surname"
        ];
    }

}


