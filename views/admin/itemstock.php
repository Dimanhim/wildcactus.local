<?php 

namespace app\models;

use Yii;
use app\components\Functions;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$count = 1;
$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Товар <b><?= $product->name ?> на складе</b></h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="clearfix">
					<div class="col-md-6">
						<div class="block_info">
							<h4>Редактирование остатков товара <b><?= $product->name ?></b></h4>
						</div>
					</div>
					<div class="col-md-12">
						<div class="block_info">
							<table class="block_description">
								<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
									<tr>
										<td>На складе</td>
										<td>
											<?= $form->field($blockForm, 'stock1')->hiddenInput(['value' => $product->stock]) ?>
										</td>
									</tr>
									<tr>
										<td>Зарезервировано</td>
										<td>
											<?= $form->field($blockForm, 'stock2')->hiddenInput(['value' => $stockOne]) ?>
										</td>
									</tr>
									<tr>
										<td>Ожидает отправки</td>
										<td>
											<?= $form->field($blockForm, 'stock3')->hiddenInput(['value' => $stockSecond]) ?>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<?= Html::submitButton('Сохранить', ['class' => 'link_btn']) ?>
										</td>
									</tr>
								<?php ActiveForm::end() ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="<?= Yii::$app->urlManager->createUrl(['admin/addproduct']) ?>" class="link_btn">Добавить новый товар</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
</script>
