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
		<h3>Баннер <b><?= $banner->id ?></b></h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Редактирование <b><?= $banner->id ?></b></h4>
						<table class="block_description">
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
								<tr>
									<td>Изображение акции</td>
									<td class="cat_main_img">
										<img src="<?= PATH.$banner->img ?>" >
									</td>
								</tr>
								<tr>
									<td>Публикация</td>
									<?php 
								    	$items = [
									    	'1' => 'Опубликовано',
									    	'0' => 'Не опубликовано',
								    	];
								    	$param = ['options' =>[ $banner->status => ['Selected' => true]]];
								    ?>
									<td>
										<?= $form->field($blockForm, 'status')->dropDownList($items, $param); ?>
									</td>
								</tr>
								<tr>
									<td>Загрузить баннер (разрешение 1920*542 px)</td>
									<td>
										<?= $form->field($blockForm, 'file')->fileInput() ?>
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
				<div class="col-md-8 col-md-offset-2 item-img">
					<img src="<?= PATH.$banner->img ?>" />
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="<?= Yii::$app->urlManager->createUrl(['admin/addbanner']) ?>" class="link_btn">Добавить новый баннер</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
</script>
