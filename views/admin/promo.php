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
		<h3>Акция <b><?= $promo->name ?></b></h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Редактирование <b><?= $promo->name ?></b></h4>
						<table class="block_description">
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
								<tr>
									<td>Изображение акции</td>
									<td class="cat_main_img">
										<img src="<?= PATH.$promo->img ?>" >
									</td>
								</tr>
								<tr>
									<td>Название</td>
									<td>
										<?= $form->field($blockForm, 'name', ['template' => "{input}"])->textInput(['value' => $promo->name]) ?>
									</td>
								</tr>
								<tr>
									<td>Описание</td>
									<td>
										<?= $form->field($blockForm, 'text1', ['template' => "{input}"])->textarea(['value' => $promo->text1]) ?>
									</td>
								</tr>
								<tr>
									<td>Описание 2</td>
									<td>
										<?= $form->field($blockForm, 'text2', ['template' => "{input}"])->textarea(['value' => $promo->text2]) ?>
									</td>
								</tr>

								<tr>
									<td>Публикация</td>
									<?php 
								    	$items = [
									    	'1' => 'Опубликовано',
									    	'0' => 'Не опубликовано',
								    	];
								    	$param = ['options' =>[ $promo->status => ['Selected' => true]]];
								    ?>
									<td>
										<?= $form->field($blockForm, 'status')->dropDownList($items, $param); ?>
									</td>
								</tr>
								<tr>
									<td>Загрузить изображение акции (разрешение 1920*542 px)</td>
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
					<img src="<?= PATH.$promo->img ?>" />
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="<?= Yii::$app->urlManager->createUrl(['admin/addpromo']) ?>" class="link_btn">Добавить новую акцию</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
</script>
