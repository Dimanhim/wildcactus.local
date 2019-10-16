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
		<h3>Изображение № <b><?= $image->id ?></b></h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="clearfix">
					<div class="col-md-6">
						<div class="block_info">
							<h4>Редактирование изображения № <b><?= $image->id ?></b></h4>
							<div class="single-image">
								<img src="<?= PATH.$image->img ?>" alt="" />
							</div>
								<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
								<?= $form->field($uploadImage, 'file')->fileInput() ?>
								<?= Html::submitButton('Загрузить новое', ['class' => 'link_btn upload-btn']) ?>
								<?php ActiveForm::end() ?>
								<div style="text-align: center">
									<a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product]) ?>"><< Назад <<</a>
								</div>
								
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
</script>
