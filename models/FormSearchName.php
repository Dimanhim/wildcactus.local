<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormSearchName extends Model
{
    /**
     * @var UploadedFile
     */
    public $name;

    public function rules()
    {
        return [
            [['name'], 'string']
        ];
    }
    
}