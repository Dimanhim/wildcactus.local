<?php 

namespace app\models;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use Yii;

use app\components\Functions;

$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Редактирование страницы Оплата-Доставка-Гарантии</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
				<div class="col-md-12">
					<div class="block_info">
						<h4>Общие данные</h4>
						<table class="block_description">
								<tr>
									<td>Заголовок страницы в браузере</td>
									<td>
										<?= $form->field($blockForm, 'title', ['template' => "{input}"])->textInput(['value' => $page->title]) ?>
									</td>
								</tr>
								<tr>
									<td>Название в маршруте</td>
									<td>
										<?= $form->field($blockForm, 'route', ['template' => "{input}"])->textInput(['value' => $page->route]) ?>
									</td>
								</tr>
								<tr>
									<td>Описание страницы (мета-тег description)</td>
									<td>
										<?= $form->field($blockForm, 'metadesc', ['template' => "{input}"])->textarea(['cols' => 20, 'rows' => 6, 'value' => $page->metadesc]) ?>
									</td>
								</tr>
						</table>
					</div>
				</div>
				<div class="col-md-12">
					<div class="block_info">
						<table class="block_description">
							<tr>
								<td>
									<?= Html::submitButton('Сохранить') ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			<?php ActiveForm::end() ?>
			<?php $form2 = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
				<div class="col-md-12">
					<div class="block_info">
						<h4>Блок Оплата</h4>
						<table class="block_description">
								<tr>
									<td>Заголовок</td>
									<td>
										<?= $form2->field($blockForm, 'header', ['template' => "{input}"])->textInput(['value' => $payment->header]) ?>
									</td>
								</tr>
								<tr>
									<td>Текст</td>
									<td>
										<?= $form2->field($blockForm, 'text', ['template' => "{input}"])->textarea(['cols' => 20, 'rows' => 6, 'value' => $payment->text]) ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?= $form2->field($blockForm, 'page', ['template' => "{input}"])->hiddenInput(['value' => 'payment']) ?>
										<?= Html::submitButton('Сохранить') ?>
									</td>
								</tr>
						</table>
					</div>
				</div>
			<?php ActiveForm::end() ?>
			<?php $form3 = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
				<div class="col-md-12">
					<div class="block_info">
						<h4>Блок Доставка</h4>
						<table class="block_description">
								<tr>
									<td>Текст блока</td>
									<td>
										<?= $form3->field($blockForm, 'text', ['template' => "{input}"])->textarea(['cols' => 20, 'rows' => 6, 'value' => $delivery->text]) ?>
									</td>
								</tr>
								<tr>
									<td>Название 1 способа</td>
									<td>
										<?= $form3->field($blockForm, 'headerfirst', ['template' => "{input}"])->textInput(['cols' => 20, 'rows' => 6, 'value' => $delivery->headerfirst]) ?>
									</td>
								</tr>
								<tr>
									<td>Текст 1 способа</td>
									<td>
										<?= $form3->field($blockForm, 'textfirst', ['template' => "{input}"])->textarea(['cols' => 20, 'rows' => 6, 'value' => $delivery->textfirst]) ?>
									</td>
								</tr>
								<tr>
									<td>Название 2 способа</td>
									<td>
										<?= $form3->field($blockForm, 'headersecond', ['template' => "{input}"])->textInput(['cols' => 20, 'rows' => 6, 'value' => $delivery->headersecond]) ?>
									</td>
								</tr>
								<tr>
									<td>Текст 2 способа</td>
									<td>
										<?= $form3->field($blockForm, 'textsecond', ['template' => "{input}"])->textarea(['cols' => 20, 'rows' => 6, 'value' => $delivery->textsecond]) ?>
									</td>
								</tr>

								<tr>
									<td colspan="2">
										<?= $form3->field($blockForm, 'page', ['template' => "{input}"])->hiddenInput(['value' => 'delivery']) ?>
										<?= Html::submitButton('Сохранить') ?>
									</td>
								</tr>
						</table>
					</div>
				</div>
			<?php ActiveForm::end() ?>
			<?php $form4 = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
				<div class="col-md-12">
					<div class="block_info">
						<h4>Блок Гарантии</h4>
						<table class="block_description">
								<tr>
									<td>
										<?= $form4->field($blockForm, 'headerone', ['template' => "{input}"])->textInput(['value' => $garantees->headerone]) ?>
									</td>
									<td>
										<?= $form4->field($blockForm, 'headertwo', ['template' => "{input}"])->textInput(['value' => $garantees->headertwo]) ?>
									</td>
									<td>
										<?= $form4->field($blockForm, 'headerthree', ['template' => "{input}"])->textInput(['value' => $garantees->headerthree]) ?>
									</td>
								</tr>
								<tr>
									<td>Текст</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'description', ['template' => "{input}"])->textarea(['cols' => 20, 'rows' => 6, 'value' => $garantees->description]) ?>
									</td>
								</tr>
								<tr>
									<td>1</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'textone', ['template' => "{input}"])->textInput(['value' => $garantees->textone]) ?>
									</td>
								</tr>
								<tr>
									<td>2</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'texttwo', ['template' => "{input}"])->textInput(['value' => $garantees->texttwo]) ?>
									</td>
								</tr>
								<tr>
									<td>3</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'textthree', ['template' => "{input}"])->textInput(['value' => $garantees->textthree]) ?>
									</td>
								</tr>
								<tr>
									<td>4</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'textfour', ['template' => "{input}"])->textInput(['value' => $garantees->textfour]) ?>
									</td>
								</tr>
								<tr>
									<td>5</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'textfive', ['template' => "{input}"])->textInput(['value' => $garantees->textfive]) ?>
									</td>
								</tr>
								<tr>
									<td>6</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'textsix', ['template' => "{input}"])->textInput(['value' => $garantees->textsix]) ?>
									</td>
								</tr>
								<tr>
									<td>7</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'textseven', ['template' => "{input}"])->textInput(['value' => $garantees->textseven]) ?>
									</td>
								</tr>
								<tr>
									<td>8</td>
									<td colspan="2">
										<?= $form4->field($blockForm, 'texteight', ['template' => "{input}"])->textInput(['value' => $garantees->texteight]) ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?= $form4->field($blockForm, 'page', ['template' => "{input}"])->hiddenInput(['value' => 'garantees']) ?>
										<?= Html::submitButton('Сохранить') ?>
									</td>
								</tr>
						</table>
					</div>
				</div>
			<?php ActiveForm::end() ?>
		</div>
	</div>
</div>
