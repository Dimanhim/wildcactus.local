<?php
namespace app\models;

use yii\base\Model;

class FormOrders extends Model
{
    /**
     * @var UploadedFile
     */
    public $id;

    public function rules()
    {
        return [
            [
                [
                'id',
            ], 
            'number'
        ]];
    }
    
}