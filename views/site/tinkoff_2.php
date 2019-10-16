<?php 
use app\models\TinkoffMerchantAPI;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
//----------- ТЕСТОВЫЙ ТЕРМИНАЛ--------------
/*$api = new TinkoffMerchantAPI(
    'TinkoffBankTest',  //Ваш Terminal_Key
    'TinkoffBankTest'   //Ваш Secret_Key
);*/


//----------- РАБОЧИЙ ТЕРМИНАЛ---------------
$api = new TinkoffMerchantAPI(
    '1558686448245',  //Ваш Terminal_Key
    'uff9q8wx0hr98np7'   //Ваш Secret_Key
);
?>
<style>.tinkoffPayRow{display:block;margin:1%;width:160px;}</style>
<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'form tinkoff', "name" => "TinkoffPayForm"]]) ?>
<?= $form->field($tinForm, 'name', ['template' => "{input}"])->textInput(["class" => "", 'placeholder' => 'Ваше имя']) ?>
<?= $form->field($tinForm, 'email', ['template' => "{input}"])->textInput(["class" => "", 'placeholder' => 'Ваш E-mail']) ?>
<?= $form->field($tinForm, 'phone', ['template' => "{input}"])->textInput(["class" => "phone", 'placeholder' => 'Номер телефона']) ?>
<?= $form->field($tinForm, 'TerminalKey', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", 'value' => '1558686448245']) ?>
<?= $form->field($tinForm, 'Amount', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "id" => "amount", "placeholder" => "Сумма заказа", "required" => "required"]) ?>
<!-- Обязательно поменять!!! -->
<?= $form->field($tinForm, 'OrderId', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => $system]) ?>
<?= $form->field($tinForm, 'description', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => "", "id" => "description"]) ?>
<?= $form->field($tinForm, 'FailURL', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => Yii::$app->urlManager->createUrl(['https://wildcactus.ru/site/false'])]) ?>
<?= $form->field($tinForm, 'NotificationURL', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow"]) ?>
<?= $form->field($tinForm, 'Comment', ['template' => "{input}"])->textarea(["class" => "tinkoffPayRow", "placeholder" => "Комментарий"]) ?>
<div class="tac">
 	<?= Html::submitButton('Оплатить', ['class' => "tinkoffPayRow main-bt green", "id" => "btn-pay"]) ?>
	<a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="main-bt">Вернуться в корзину</a>
</div>
<?php ActiveForm::end() ?>
