<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormAdv extends Model
{
    /**
     * @var UploadedFile
     */
    public $a1h;
    public $a1t;
    public $a2h;
    public $a2t;
    public $a3h;
    public $a3t;
    public $a4h;
    public $a4t;
    public $a5h;
    public $a5t;
    public $a6h;
    public $a6t;


    public function rules()
    {
        return [
            [['a1h', 'a1t', 'a2h', 'a2t', 'a3h', 'a3t', 'a4h', 'a4t', 'a5h', 'a5t', 'a6h', 'a6t', ], 'string'],
        ];
    }
    
}