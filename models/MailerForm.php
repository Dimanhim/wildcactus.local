<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class MailerForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $btn;
    public $plan;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [


        ];
    }

}
