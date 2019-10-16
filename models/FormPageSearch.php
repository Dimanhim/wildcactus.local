<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormPageSearch extends Model
{
    /**
     * @var UploadedFile
     */
    public $search;
    

    public function rules()
    {
        return [
            [['search'], 'string'],
        ];
    }
    
}