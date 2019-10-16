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
		<h3>Добавление товара</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Товар</h4>
						<table class="block_description">
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
								<tr>
									<td>Штрих код</td>
									<td>
										<?= $form->field($addForm, 'barcode', ['template' => "{input}"])->textInput(['autofocus' => 'autofocus']) ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?= Html::submitButton('Добавить') ?>
									</td>
								</tr>
							<?php ActiveForm::end() ?>
						</table>
					</div>
				</div>

			<?php if($editNew) { ?>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Редактирование товара <b><?= $product->name ?></b></h4>
						<?php require_once "formproduct.php" ?>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
