<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormAddProduct extends Model
{
    /**
     * @var UploadedFile
     */
    public $status;
    public $barcode;
    public $name;
    public $hit;
    public $new;
    public $promo;
    public $price;

    public function rules()
    {
        return [
            [['status', 'barcode', 'hit', 'new', 'promo', 'price'], 'number'],
            [['name'], 'string']
        ];
    }
    
}