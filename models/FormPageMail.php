<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormPageMail extends Model
{
    /**
     * @var UploadedFile
     */
    public $name;
    public $phone;
    public $email;
    public $btn;
    public $plan;

    public function rules()
    {
        return [
            [['name', 'phone', 'btn', 'plan'], 'string'],
            [['email'], 'email'],
        ];
    }
    
}