<?php
namespace app\models;

use yii\base\Model;

class FormTinkoff extends Model
{
    /**
     * @var UploadedFile
     */
    public $TerminalKey;
    public $Amount;
    public $OrderId;
    public $IP;
    public $Description;
    public $Token;
    public $Language;
    public $SuccessURL;
    public $FailURL;
    public $PayType;
    public $name;
    public $email;
    public $phone;
    public $description;
    public $Comment;
    public $NotificationURL;

    public function rules()
    {
        return [
            [
                [
                    'TerminalKey',
                     'Amount',
                     'OrderId',
                     'IP',
                     'Description',
                     'Token',
                     'Language',
                     'SuccessURL',
                     'FailURL',
                     'PayType',
                     'name',
                     'email',
                     'description',
                     'phone',
                     'Comment',
                     'NotificationURL'
                 ],
            'string'
            ],
        ];
    }
    
}