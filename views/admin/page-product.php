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
						<h4>Общее описание для всех товаров</h4>
						<table class="block_description">
							
								<tr>
									<td>Заголовок</td>
									<td>
										<?= $form->field($blockForm, 'header_product', ['template' => "{input}"])->textInput(['value' => $page->header_product]) ?>
									</td>
								</tr>
								<tr>
									<td>Описание</td>
									<td>
										<?= $form->field($blockForm, 'text_product', ['template' => "{input}"])->textarea(['cols' => 20, 'rows' => 6, 'value' => $page->text_product]) ?>
									</td>
								</tr>
								<tr>
									<td colspan="2"><?= Html::submitButton('Сохранить') ?></td>
								</tr>
						</table>
					</div>
				</div>
			<?php ActiveForm::end() ?>
		</div>
	</div>
</div>
