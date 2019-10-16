<?php
namespace app\widgets\mail;
use app\models\FormPageMail;

class MailWidget extends \yii\base\Widget
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
            'pageForm' => new FormPageMail(),
        ]);
    }
}