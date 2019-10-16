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
		<h3>Категория <b><?= $category->name ?></b></h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Редактирование категории <b><?= $category->name ?></b></h4>
						<table class="block_description">
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
								<tr>
									<td>Изображение категории</td>
									<td class="cat_main_img">
										<img src="<?= PATH.$category->img ?>" >
									</td>
								</tr>
								<tr>
									<td>Сортировка</td>
									<td>
										<?= $form->field($blockForm, 'orderby', ['template' => "{input}"])->textInput(['value' => $category->orderby]) ?>
									</td>
								</tr>
								<tr>
									<td>Название</td>
									<td>
										<?= $form->field($blockForm, 'name', ['template' => "{input}"])->textInput(['value' => $category->name]) ?>
									</td>
								</tr>
								<tr>
									<td>Описание</td>
									<td>
										<?= $form->field($blockForm, 'description', ['template' => "{input}"])->textarea(['value' => $category->description]) ?>
									</td>
								</tr>
								<tr>
									<td>Алиас (ссылка)</td>
									<td>
										<?= $category->alias ?>
									</td>
								</tr>
								<tr>
									<td>Публикация</td>
									<?php 
								    	$items = [
									    	'1' => 'Опубликовано',
									    	'0' => 'Не опубликовано',
								    	];
								    	$param = ['options' =>[ $category->status => ['Selected' => true]]];
								    ?>
									<td>
										<?= $form->field($blockForm, 'status')->dropDownList($items, $param); ?>
									</td>
								</tr>
								<tr>
									<td>Родительская категория</td>
									<?php

									foreach($categories as $arr_category) {
										$items2[$arr_category->id] = $arr_category->name;
									}
								    	
								    	$param = ['options' =>[ $category->parent => ['Selected' => true]], 'prompt' => 'Выбрать...'];
								    ?>
									<td>
										<?= $form->field($blockForm, 'parent')->dropDownList($items2, $param); ?>
									</td>
								</tr>
								<tr>
									<td>Загрузить изображение категории</td>
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
				<div class="col-md-3">
					<div class="block_info">
						<h4>Товары категории</h4>
						<table class="table">
						<?php if(!$products) { ?>
							<tr>
								<td>В данной категории товаров нет</td>
							</tr>
						<?php } ?>
						<?php foreach($products as $product) { ?>
							<tr>
							
								<td class="cat-img">
									<a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product->id]) ?>">
										<img src="<?= PATH.$product->img ?>" />
									</a>
								</td>
								<td>
									<a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product->id]) ?>">
										<?= $product->name ?>
											
									</a>
								</td>
							</tr>
						<?php } ?>
						</table>
					</div>
				</div>
				<?php require_once "rightCategories.php" ?>
			</div>
		</div>

		<h3>Подкатегории из категории <b><?= $category->name ?></b></h3>
		<table class="table">
			<tr class="header_tr">
				<td>№</td>
				<td>Изображение</td>
				<td>Название</td>
				<td>Функции</td>
			</tr>
		<?php foreach($undercategories as $undercategory) { ?>
			<tr>
				<td><?=$count?></td>
				<td class="cat-img">
					<img src="<?= PATH.$undercategory->img ?>" alt="" />
				</td>
				<td><?=$undercategory->name?></td>
				<td class="edit">
					<a href="<?= Yii::$app->urlManager->createUrl(['admin/category', 'id' => $undercategory->id]) ?>"><img src="/web/images/admin/view.png" alt="" title="просмотр"></a>
				</td>
			</tr>
			<?php $count++ ?>
		<?php } ?>
		</table>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="<?= Yii::$app->urlManager->createUrl(['admin/addcategory']) ?>" class="link_btn">Добавить новую категорию</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
</script>
