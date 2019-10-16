<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormDeleteImage extends Model
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