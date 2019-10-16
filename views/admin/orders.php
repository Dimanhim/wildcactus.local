<?php 

namespace app\models;

use Yii;
use yii\widgets\LinkPager;
use app\components\Functions;
$count = 1;
$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Заявки</h3>

		<!-- Сортировка по датам -->
		<?php require_once 'changeDate.php' ?>
		
		<table class="table">
			<tr class="header_tr">
				<td>№</td>
				<td>Название</td>
				<td>Статус</td>
				<td>Дата</td>
				<td>Имя</td>
				<td>Телефон</td>
				<td>Переход с сайта</td>
				<td>Стоимость</td>
				<td>Функции</td>
			</tr>
		<?php foreach($orders as $order) { ?>
			
				<tr>
					
					<td>
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/order', 'id' => $order->id]) ?>">
							<?=$count?>
						</a>
					</td>
					<td>
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/order', 'id' => $order->id]) ?>">
							<?=$order->ordername?>
						</a>
					</td>
					<td><?=$function->getStatus($order->status)?></td>
					<td>
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/order', 'id' => $order->id]) ?>">
							<?=$function->getDate($order->date_order)?>
						</a>
					</td>
					<td><?=$order->name?></td>
					<td><a href="tel:<?=$order->phone?>"><?=$order->phone?></a></td>
					<td><?=$order->utm_source?></td>
					<td><?=$order->price?></td>
					<td class="edit">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/order', 'id' => $order->id]) ?>"><img src="/web/images/admin/view.png" alt="" title="просмотр и редактирование"></a>
						<!--<a href="<?//= Yii::$app->urlManager->createUrl(['admin/orders', 'delete' => 'delete', 'id' => $order->id]) ?>" class="delete"><img src="/web/images/admin/delete.png" alt="" title="удаление">-->
						<form action="" class="delete_form" method="post">
							<input type="hidden" name="id" value="<?= $order->id ?>" />
							<button name="delete" class="delete" value="delete"><img src="/web/images/admin/delete.png" alt="" title="удаление"></button>
						</form>
					</td>
				</a>
				</tr>	
			
			
			<?php $count++ ?>
		<?php } ?>
		</table>
		<?= LinkPager::widget(['pagination' => $pagination])  ?>
	</div>
</div>
<script>
	jQuery('.edit .delete img').on('click', function() {
        if(!confirm("Вы уверены, что хотите удалить заявку?")) return false;
    });
</script>
