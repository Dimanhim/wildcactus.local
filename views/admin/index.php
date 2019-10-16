<?php 

namespace app\components;

use Yii;

use app\components\Functions;

$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Общая статистика</h3>

		<!-- Сортировка по датам -->
		<?php require_once 'changeDate.php' ?>
		
		<table class="table">
			<tr>
				<td>Общее количество заявок</td>
				<td><?= $countOrders ?></td>
			</tr>
			<tr>
				<td>Заявки в работе</td>
				<td><?= $countWorkOrders ?></td>
			</tr>
			<tr>
				<td>Выполненные</td>
				<td><?= $countDoneOrders ?></td>
			</tr>
			<tr>
				<td>Заявки в архиве</td>
				<td><?= $countArchiveOrders ?></td>
			</tr>
			<tr>
				<td>Общая сумма заявок</td>
				<td><?= $totalAmount ?></td>
			</tr>
			<tr>
				<td>Общая потраченная сумма</td>
				<td><?= $totalSummMinus ?></td>
			</tr>
			<tr>
				<td>Оплачено по заявкам</td>
				<td><?= $totalSummPlus ?></td>
			</tr>
			<tr>
				<td>Всего прибыль по заявкам</td>
				<td><?= $profit ?></td>
			</tr>
		</table>
	</div>
</div>
