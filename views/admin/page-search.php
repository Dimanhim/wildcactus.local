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
		<h3>Редактирование страницы Поиск</h3>
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
		</div>
	</div>
</div>
