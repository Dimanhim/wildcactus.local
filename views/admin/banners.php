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
		<h3>Баннеры на главной</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="col-md-12">
			<table class="table">
				<tr class="header_tr">
					<td>№</td>
					<td>Изображение</td>
					<td>Статус</td>
					<td>Функции</td>
				</tr>
			<?php foreach($banners as $banner) { ?>
				<tr>
					<td><?=$count?></td>
					<td class="promo-img">
						<img src="<?= PATH.$banner->img ?>" alt=""<?php if($banner->img) { ?> style="width: 300px"<?php } ?> />
					</td>
					<td><?= $function->getStatusByNumber($banner->status)?></td>
					<td>
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/banner', 'id' => $banner->id]) ?>"><img src="/web/images/admin/view.png" alt="" title="просмотр"></a>
					<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'delete_form']]) ?>
					<?= $form->field($blockForm, 'id', ['template' => "{input}"])->hiddenInput(['value' => $banner->id]) ?>
					<?= Html::submitButton("<img src='/web/images/admin/delete.png' alt='' title='удаление'>", ['class' => 'delete']) ?>
					<?php ActiveForm::end() ?>
					</td>
				</tr>
				<?php $count++ ?>
			<?php } ?>
			</table>	
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<a href="<?= Yii::$app->urlManager->createUrl(['admin/addbanner']) ?>" class="link_btn">Добавить баннер</a>
				</div>
			</div>
		</div>
		
	</div>
</div>
<script>
</script>
