<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormPage extends Model
{
    /**
     * @var UploadedFile
     */
    public $name;
    public $phone;
    public $email;
    public $btn;
    public $plan;
    public $city;
    public $cityid;

    public function rules()
    {
        return [
            [['name', 'phone', 'btn', 'plan', 'city'], 'string'],
            [['cityid'], 'number'],
            [['email'], 'email'],
        ];
    }
    
}