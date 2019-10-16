<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormOptions extends Model
{
    /**
     * @var UploadedFile
     */
    public $siteemail;
    public $phone;
    public $req;
    public $insta;

    public function rules()
    {
        return [
            [
                [
                'siteemail',
                'phone',
                'req', 
                'insta'
            ], 
            'string'
        ]];
    }
    
}