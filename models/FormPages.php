<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormPages extends Model
{
    /**
     * @var UploadedFile
     */
    public $page;
    public $title;
    public $route;
    public $metadesc;
    public $about;
    public $header;
    public $headerfirst;
    public $headersecond;
    public $headerone;
    public $headertwo;
    public $headerthree;
    public $description;
    public $text;
    public $textfirst;
    public $textsecond;
    public $textone;
    public $texttwo;
    public $textthree;
    public $textfour;
    public $textfive;
    public $textsix;
    public $textseven;
    public $texteight;
    public $adv;
    public $file;
    public $search;
    public $header_product;
    public $text_product;

    public function rules()
    {
        return [
            [
                [
                'page',
                'title',
                'route', 
                'metadesc', 
                'header', 
                'headerfirst', 
                'headersecond', 
                'headerone', 
                'headertwo', 
                'headerthree', 
                'description', 
                'about', 
                'text', 
                'textfirst', 
                'textsecond', 
                'textone', 
                'texttwo', 
                'textthree', 
                'textfour', 
                'textfive', 
                'textsix', 
                'textseven', 
                'texteight', 
                'adv',
                'search',
                'header_product',
                'text_product'
            ], 
            'string'
        ],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
}