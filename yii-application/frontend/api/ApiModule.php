<?php

namespace frontend\api;

use yii\base\Module;

class ApiModule extends Module
{
    public function init()
    {
        parent::init();
        $this->controllerNamespace = 'frontend\api';
    }
}