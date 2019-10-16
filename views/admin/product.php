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
		<h3>Товар <b><?= $product->name ?></b></h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Редактирование товара <b><?= $product->name ?></b></h4>
						<?php require_once "formproduct.php" ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Картинки товара</h4>
						<div class="row" style="margin: 0">
						<?php $count = 1 ?>
						<?php foreach($images as $image) { ?>
							<div class="col-md-4 item-img">
								<a href="<?= Yii::$app->urlManager->createUrl(['admin/productimg', 'id' => $image->id, 'product' => $product->id]) ?>">
									<img src="<?= PATH.$image->img ?>">
									<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
									<?= $form->field($formDelete, 'id')->hiddenInput(['value' => $image->id]) ?>
									<?= Html::submitButton('Удалить', ['class' => 'delete-button link_btn upload-btn']) ?>
									<?php ActiveForm::end() ?>
								</a>									
							</div>
						<?php if($count%3 == 0) { ?><div class="clearfix"></div><?php } ?>
						<?php $count++ ?>
						<?php } ?>


						<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
						<?= $form->field($uploadImage, 'file')->fileInput() ?>
						<?= Html::submitButton('Загрузить новое', ['class' => 'link_btn upload-btn']) ?>
						<?php ActiveForm::end() ?>
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
