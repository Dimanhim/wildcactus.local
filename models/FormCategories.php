<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class FormCategories extends Model
{
    /**
     * @var UploadedFile
     */
    public $id;
    public $file;
    public $name;
    public $description;
    public $alias;
    public $status;
    public $level;
    public $parent;
    public $barcode;
    public $category;
    public $hit;
    public $new;
    public $promo;
    public $orderby;
    public $stock;
    public $price;
    public $series;
    public $model;
    public $material;
    public $text1;
    public $text2;
    public $search;

    public function rules()
    {
        return [
            [['name', 'description', 'alias', 'series', 'model', 'material', 'text1', 'text2', 'search'], 'string'],
            [['status', 'level', 'parent', 'id', 'barcode', 'category', 'hit', 'new', 'promo', 'orderby', 'price'], 'number'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
}