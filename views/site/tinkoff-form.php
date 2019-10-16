<?php $form = ActiveForm::begin(['action' => 'https://securepay.tinkoff.ru/v2/Init', 'fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'form tinkoff', "name" => "TinkoffPayForm"]]) ?>
<?= $form->field($tinForm, 'TerminalKey', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", 'value' => '1558686448245DEMO']) ?>
<?= $form->field($tinForm, 'Amount', ['template' => "{input}"])->textInput(["class" => "tinkoffPayRow", "id" => "amount", "placeholder" => "Сумма заказа", "required" => "required"]) ?>
<?= $form->field($tinForm, 'OrderId', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => $product->id]) ?>
<?= $form->field($tinForm, 'IP', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => $_SERVER['REMOTE_ADDR']]) ?>
<?= $form->field($tinForm, 'Description', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => $product->name]) ?>
<?= $form->field($tinForm, 'Token', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => "kghjmrddees466yvbv"]) ?>
<?= $form->field($tinForm, 'Language', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => "ru"]) ?>
<?= $form->field($tinForm, 'SuccessURL', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => Yii::$app->urlManager->createUrl(['site/success'])]) ?>
<?= $form->field($tinForm, 'FailURL', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => Yii::$app->urlManager->createUrl(['site/false'])]) ?>
<?= $form->field($tinForm, 'PayType', ['template' => "{input}"])->hiddenInput(["class" => "tinkoffPayRow", "value" => "O"]) ?>
<div class="tac">
 <!--<a href="<?//= Yii::$app->urlManager->createUrl(['site/pay']) ?>" class="main-bt green">Оплатить</a>-->
 	<?= Html::submitButton('Оплатить', ['class' => "tinkoffPayRow main-bt green", "id" => "btn-pay"]) ?>
	<a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="main-bt">Вернуться в корзину</a>
</div>

<?php ActiveForm::end() ?>
</form>