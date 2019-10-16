<?php
namespace app\widgets\city;
use app\models\FormPage;

class SubscribeWidget extends \yii\base\Widget
{
    public function init()
    {
        return parent::init();
    }

    public function run()
    {
        /*
         * Какое-либо действие, логика, создание модели и тд
         */

        return $this->render('form', [
            'model' => $model,
            'pageForm' => new FormPage(),
        ]);
    }
}