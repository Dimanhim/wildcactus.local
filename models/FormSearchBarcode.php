<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormSearchBarcode extends Model
{
    /**
     * @var UploadedFile
     */
    public $barcode;

    public function rules()
    {
        return [
            [['barcode'], 'number'],
        ];
    }
    
}