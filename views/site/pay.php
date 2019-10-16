<?php
use app\components\Functions;
use yii\helpers\Url;
$functions = new Functions();
$this->title = "Оплата заказа";
$this->params['breadcrumbs'][] = array(
    'label'=> "Оплата заказа",
    'url'=>Url::toRoute("/pay.html")
);
?>
<div class="payment-page">
    <div class="container">
        <?php require_once "tinkoff.php" ?>
    </div>
</div>

