<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormAlias extends Model
{
    /**
     * @var UploadedFile
     */
    public $alias;

    public function rules()
    {
        return [
            [['alias'], 'string'],
        ];
    }
    
}