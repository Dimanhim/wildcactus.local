<?php
namespace app\widgets\search;
use app\models\FormPageSearch;

class SearchWidget extends \yii\base\Widget
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
            'pageForm' => new FormPageSearch(),
        ]);
    }
}