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
		<h3>Добавление категории</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-9">
					<div class="block_info">
						<h4>Категория</h4>
						<table class="block_description">
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
								<tr>
									<td>Название</td>
									<td>
										<?= $form->field($blockForm, 'name', ['template' => "{input}"])->textInput() ?>
									</td>
								</tr>
								<tr>
									<td>Описание</td>
									<td>
										<?= $form->field($blockForm, 'description', ['template' => "{input}"])->textarea() ?>
									</td>
								</tr>
								<tr>
									<td>Алиас (ссылка)</td>
									<td>
										<?= $form->field($blockForm, 'alias', ['template' => "{input}"])->textInput(['placeholder' => 'chehol-dlya-iphone7-s-kartinkoi']) ?>
									</td>
								</tr>
								<tr>
									<td>Родительская категория</td>
									<?php

									foreach($categories as $arr_category) {
										$items[$arr_category->id] = $arr_category->name;
									}
								    	
								    	$param = ['options' =>[ $category->parent => ['Selected' => true]], 'prompt' => 'Выбрать...'];
								    ?>
									<td>
										<?= $form->field($blockForm, 'parent')->dropDownList($items, $param); ?>
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
				<?php require_once "rightCategories.php" ?>	
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="<?= Yii::$app->urlManager->createUrl(['admin/addcategory']) ?>" class="link_btn">Добавить новую категорию</a>
				</div>
			</div>
		</div>
	</div>
</div>
