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
		<h3>Редактирование главной страницы</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
				<div class="col-md-12">
					<div class="block_info">
						<h4>Данные</h4>
						<table class="block_description">
							
								<tr>
									<td>Заголовок страницы в браузере</td>
									<td>
										<?= $form->field($blockForm, 'title', ['template' => "{input}"])->textInput(['value' => $page->title]) ?>
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
						<h4>Текст О компании</h4>
						<table class="block_description">
								<tr>
									<td>Заголовок</td>
									<td>
										<?= $form->field($blockForm, 'header', ['template' => "{input}"])->textInput(['value' => $page->header]) ?>
									</td>
								</tr>
								<tr>
									<td>Текст 1</td>
									<td>
										<?= $form->field($blockForm, 'about', ['template' => "{input}"])->textarea(['value' => $page->about]) ?>
									</td>
								</tr>
								<tr>
									<td>Текст 2</td>
									<td>
										<?= $form->field($blockForm, 'text', ['template' => "{input}"])->textarea(['value' => $page->text]) ?>
									</td>
								</tr>
						</table>
					</div>
				</div>
				<div class="col-md-12">
					<div class="block_info">
						<table class="block_description">
							<tr>
								<td>Заголовок блока преимуществ</td>
								<td>
									<?= $form->field($blockForm, 'adv', ['template' => "{input}"])->textInput(['value' => $page->adv]) ?>
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
			<div class="clear"></div>
			<?php 
				$form2 = ActiveForm::begin([
					'fieldConfig' => [
						'options' => [
							'tag' => false
						]
					], 
					'options' => [
						'class' => 'send-data'
					]]
				) 
			?>
				<div class="col-md-12">
					<div class="block_info">
						<h4>Преимущества</h4>
						<table class="block_description">
								<!--<tr>
									<td>Заголовок</td>
									<td colspan="2">
										<?//= $form2->field($blockForm, 'adv', ['template' => "{input}"])->textInput(['value' => $page->adv]) ?>
									</td>
								</tr>-->
								<tr class="">
									<td>№ блока</td>
									<td>Заголовок</td>
									<td>Описание</td>
								</tr>
								

								<tr>
									<td>1</td>
									<td>
										<?= $form2->field($advForm, 'a1h', ['template' => "{input}"])->textInput(['value' => $adv->a1h]) ?>
									</td>
									<td>
										<?= $form2->field($advForm, 'a1t', ['template' => "{input}"])->textarea(['value' => $adv->a1t]) ?>
									</td>
								</tr>
								<tr>
									<td>2</td>
									<td>
										<?= $form2->field($advForm, 'a2h', ['template' => "{input}"])->textInput(['value' => $adv->a2h]) ?>
									</td>
									<td>
										<?= $form2->field($advForm, 'a2t', ['template' => "{input}"])->textarea(['value' => $adv->a2t]) ?>
									</td>
								</tr>
								<tr>
									<td>3</td>
									<td>
										<?= $form2->field($advForm, 'a3h', ['template' => "{input}"])->textInput(['value' => $adv->a3h]) ?>
									</td>
									<td>
										<?= $form2->field($advForm, 'a3t', ['template' => "{input}"])->textarea(['value' => $adv->a3t]) ?>
									</td>
								</tr>
								<tr>
									<td>4</td>
									<td>
										<?= $form2->field($advForm, 'a4h', ['template' => "{input}"])->textInput(['value' => $adv->a4h]) ?>
									</td>
									<td>
										<?= $form2->field($advForm, 'a4t', ['template' => "{input}"])->textarea(['value' => $adv->a4t]) ?>
									</td>
								</tr>
								<tr>
									<td>5</td>
									<td>
										<?= $form2->field($advForm, 'a5h', ['template' => "{input}"])->textInput(['value' => $adv->a5h]) ?>
									</td>
									<td>
										<?= $form2->field($advForm, 'a5t', ['template' => "{input}"])->textarea(['value' => $adv->a5t]) ?>
									</td>
								</tr>
								<tr>
									<td>6</td>
									<td>
										<?= $form2->field($advForm, 'a6h', ['template' => "{input}"])->textInput(['value' => $adv->a6h]) ?>
									</td>
									<td>
										<?= $form2->field($advForm, 'a6t', ['template' => "{input}"])->textarea(['value' => $adv->a6t]) ?>
									</td>
								</tr>
								<tr>
									<td colspan="3">
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
