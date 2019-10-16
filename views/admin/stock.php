<?php 

namespace app\models;

use Yii;
use app\components\Functions;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\Html;
$count = 1;
$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Товары</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="col-md-12">
			<div class="block_info">
				<h4>На складе</h4>
				<table class="block_description">
					<tr class="header_tr">
						<td>№</td>
						<td>Изображение</td>
						<td>Товар</td>
						<td>Цена</td>
						<td>Количество <br />(редактировать)</td>
						<td colspan="2">Функции</td>
					</tr>
				<?php foreach($products as $product) { ?>
					<?php //if($product->stock != 0) { ?>
					<tr>
						<td><?=$count?></td>
						<td class="cat-img">
							<a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product->id]) ?>">
								<img src="<?= PATH.$product->img ?>" alt="" />
							</a>
						</td>
						<td><a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product->id]) ?>"><?=$product->name?></a></td>
						<td><?=$product->price?></td>
						<td><a href="<?= Yii::$app->urlManager->createUrl(['admin/itemstock', 'id' => $product->id]) ?>" class="value" data-product="<?=$product->id?>"><?=$product->stock?></a></td>
						<td>
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data-plus']]) ?>
							<?= $form->field($addStock, 'id', ['template' => "{input}"])->hiddenInput(['value' => $product->id]) ?>
							<?= Html::submitButton('+ 1') ?>
							<?php ActiveForm::end() ?>
						</td>
						<td>
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data-plus']]) ?>
							<?= $form->field($deleteStock, 'id', ['template' => "{input}"])->hiddenInput(['value' => $product->id]) ?>
							<?= Html::submitButton('- 1') ?>
							<?php ActiveForm::end() ?>
						</td>
						
						
					</tr>
					<?php $count++ ?>
					<?php //} ?>
				<?php } ?>
				</table>	
			</div>
		</div>
		<?//= LinkPager::widget(['pagination' => $pagination])  ?>
		<?php $count = 1 ?>
		<div class="col-md-12">
			<div class="block_info">
				<h4>В работе</h4>
				<table class="block_description">
					<tr class="header_tr">
						<td>№</td>
						<td>Изображение</td>
						<td>Товар</td>
						<td>Покупатель</td>
						<!--<td colspan="2">Статус</td>-->
					</tr>
				<?php foreach($stocks as $stock) { ?>
					<tr>
						<td><?=$count?></td>
						<td class="cat-img">
							<a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $stock->product]) ?>">
								<img src="<?= PATH.$function->getProduct($stock->product)->img ?>" alt="" />
							</a>
						</td>
						<td>
							<a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $stock->product]) ?>"><?= $function->getProduct($stock->product)->name?>
								
							</a>
						</td>
						<td>
							<b><a href="<?= Yii::$app->urlManager->createUrl(['admin/order', 'id' => $stock->orderid]) ?>">Заказчик
								
							</a></b>
						</td>
						<td>
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
							<?php
								$items = [
									'1' => 'Отправить',
									'2' => 'Ожидает отправки',
								];
						    	$param = [
						    		'options' => [ 
						    			$stock->status => [
						    				'Selected' => true
						    			]
						    		],
						    		'prompt' => 'Выбрать...'
						    	];
						    ?>
							<?= $form->field($changeStatus, 'status')->dropDownList($items, $param); ?>
							<?= $form->field($changeStatus, 'id')->hiddenInput(['value' => $stock->id]);?>
						</td>
						<td>
							<?= Html::submitButton('ОК') ?>
							<?php ActiveForm::end() ?>
						</td>
					</tr>
					<?php $count++ ?>
				<?php } ?>
				</table>	
			</div>
		</div>
		
	</div>
</div>
