<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormAddStock extends Model
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