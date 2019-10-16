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
		<h3>Категории товаров</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="row">
			<div class="col-md-9">
				<table class="table">
					<tr class="header_tr">
						<td>№</td>
						<td>Сортировка</td>
						<td>Название</td>
						<td>Статус</td>
						<td>Алиас</td>
						<td>Количество подкатегорий</td>
						<td>Функции</td>
					</tr>
				<?php foreach($categories as $category) { ?>
					<?php if($category->level == 1) { ?>
					<tr>
						<td><?=$count?></td>
						<td><?=$category->orderby?></td>
						<td><a href="<?= Yii::$app->urlManager->createUrl(['admin/category', 'id' => $category->id]) ?>"><?=$category->name?></a></td>
						<td><?= $function->getStatusByNumber($category->status)?></td>
						<td><?=$category->alias?></td>
						<td class="child-cat"><?= $function->getChildrenCategories($category->id) ?></td>
						<td>
							<a href="<?= Yii::$app->urlManager->createUrl(['admin/category', 'id' => $category->id]) ?>"><img src="/web/images/admin/view.png" alt="" title="просмотр"></a>
						<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'delete_form']]) ?>
						<?= $form->field($blockForm, 'id', ['template' => "{input}"])->hiddenInput(['value' => $category->id]) ?>
						<?= Html::submitButton("<img src='/web/images/admin/delete.png' alt='' title='удаление'>", ['class' => 'delete']) ?>
						<?php ActiveForm::end() ?>
						</td>
					</tr>
					<?php $count++ ?>
					<?php } ?>
				<?php } ?>
				</table>
			</div>
			
			<?php require_once "rightCategories.php" ?>	
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
<script>
</script>
