<?php 

namespace app\models;

use Yii;

use app\components\Functions;

$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Ключевые фразы</h3>

		<!-- Сортировка по датам -->
		<?php require_once 'changeDate.php' ?>

		<table class="table">
			<tr class="header_tr">
				<td>Фраза</td>
				<td>Количество заявок</td>
				<td>Процент заявок</td>
			</tr>
		<?php $count_all = 0 ?>
		<?php $count_percent = 0 ?>
		<?php foreach($orders_unique as $order) { ?>
		<?php 
			$persentSplit = $function->getPercentTerm($orders, $order);
	        $countSplit = $function->countTermOrders($orders, $order); 
        ?>
			<tr>
				<td><a href="<?= Yii::$app->urlManager->createUrl(['admin/orders', 'term' => $order, 'quan' => 'all']) ?>"><?= $order ?></a></td>
				<td><?= $countSplit ?></td>
				<td><?= $persentSplit ?>%</td>
			</tr>
		<?php $count_all = $count_all + $countSplit ?>
		<?php $count_percent = $count_percent + $persentSplit ?>
		<?php } ?>
			<tr>
				<td><strong>Всего</strong></td>
				<td><strong><?= $count_all ?></strong></td>
				<td><?= $count_percent ?></td>
			</tr>
		</table>
	</div>
</div>