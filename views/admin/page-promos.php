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
		<h3>Редактирование страницы "Акции"</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="block_info">
						<h4>Акции</h4>
						<table class="block_description">
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
								<tr>
									<td>Заголовок страницы в браузере</td>
									<td>
										<?= $form->field($blockForm, 'title', ['template' => "{input}"])->textInput(['value' => $promo->title]) ?>
									</td>
								</tr>
								<tr>
									<td>Название в маршруте</td>
									<td>
										<?= $form->field($blockForm, 'route', ['template' => "{input}"])->textInput(['value' => $promo->route]) ?>
									</td>
								</tr>
								<tr>
									<td>Описание страницы (мета-тег description)</td>
									<td>
										<?= $form->field($blockForm, 'metadesc', ['template' => "{input}"])->textarea(['value' => $promo->metadesc]) ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?= Html::submitButton('Сохранить') ?>
									</td>
								</tr>
							<?php ActiveForm::end() ?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
