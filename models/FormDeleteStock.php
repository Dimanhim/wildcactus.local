<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormDeleteStock extends Model
{
    /**
     * @var UploadedFile
     */
    public $id;

    public function rules()
    {
        return [
            [['id'], 'string'],
        ];
    }
    
}