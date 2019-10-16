<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormCart extends Model
{
    /**
     * @var UploadedFile
     */
    public $plan;

    public function rules()
    {
        return [
            [['plan'], 'string'],
        ];
    }
    
}