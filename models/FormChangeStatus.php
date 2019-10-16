<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormChangeStatus extends Model
{
    /**
     * @var UploadedFile
     */
    public $id;
    public $status;

    public function rules()
    {
        return [
            [['id', 'status'], 'string'],
        ];
    }
    
}