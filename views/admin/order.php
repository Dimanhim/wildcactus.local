<?php 

namespace app\models;

use Yii;

use app\components\Functions;

$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Заказ № <?= $order->id; ?></h3>
		<p><span style="color: #f00"><?= $message ?></span></p>
		<!--<h3 class="error"></h3>-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Информация о заявке</h4>
						<table class="block_description">
							<tr>
								<td>id</td>
								<td><span><?= $order->id; ?></span></td>
								<td></td>
							</tr>
							<tr>
								<td>Название</td>
								<td class="edit">
									<span class="edit_span">
										<?= $order->ordername ?>
									</span>
									<span class="edit_form">
										<form class="template_form">
										</form>
										<form class="template_form">
											<input type="text" name="ordername" value="<?= $order->ordername ?>" />
											<input type="hidden" name="id" value="<?= $order->id ?>">
											<button name="edit_field">ОК</button>
										</form>
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Статус</td>
								<td class="edit">
									<span class="edit_span">
										<?= $function->getStatus($order->status) ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form">
											<select name="status">
												<option <?php if($order->status != 0 && $order->status != 1 && $order->status != 2) { ?>selected <?php } ?>value="4">нет</option>
												<option <?php if($order->status == 3) { ?>selected <?php } ?>value="3">В работе</option>
												<option <?php if($order->status == 1) { ?>selected <?php } ?>value="1">В архив</option>
												<option <?php if($order->status == 2) { ?>selected <?php } ?>value="2">Выполнен</option>
											</select>
											<input type="hidden" name="id" value="<?= $order->id; ?>">
											<button name="edit_field">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href="#"><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Дата</td>
								<td><span><?=$function->getDate($order->date_order)?></span></td>
								<td></td>
							</tr>
							<tr>
								<td>Имя</td>
								<td class="edit">
									<span class="edit_span">
										<?= $order->name ?>
									</span>
									<span class="edit_form">
										<form class="template_form">
										</form>
										<form class="template_form">
											<input type="text" name="name" value="<?= $order->name ?>" />
											<input type="hidden" name="id" value="<?= $order->id ?>">
											<button name="edit_field">ОК</button>
										</form>
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Телефон</td>
								<td class="edit">
									<span class="edit_span">
										<?= $order->phone ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form">
											<input type="text" name="phone" value="<?= $order->phone ?>" />
											<input type="hidden" name="id" value="<?= $order->id ?>">
											<button name="edit_field">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Email</td>
								<td class="edit">
									<span class="edit_span">
										<?= $order->email ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form">
											<input type="text" name="email" value="<?= $order->email ?>" />
											<input type="hidden" name="id" value="<?= $order->id ?>">
											<button name="edit_field">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Сумма заказа</td>
								<td>
									<textarea><?= $order->plan ?></textarea>
								</td>
							</tr>
						</table>
					</div>
				</div>

				<div class="col-md-6">
					<div class="block_info">
						<h4>Аналитика</h4>
						<table class="block_description">
							<tr>
								<td>Сплит-шаблон</td>
								<td><span><?= $order->split ?></span></td>
							</tr>
							<tr>
								<td>Нажатая кнопка</td>
								<td><span><?= $order->btn ?></span></td>
							</tr>
							<tr>
								<td>Переход с сайта</td>
								<td><span><?= $order->utm_source ?></span></td>
							</tr>
							<tr>
								<td>ID рекламной кампании/Город</td>
								<td><span><?= $order->utm_campaign ?></span></td>
							</tr>
							<tr>
								<td>ID объявления/тип/позиция</td>
								<td><span><?= $order->utm_content ?></span></td>
							</tr>
							<tr>
								<td>Ключевая фраза</td>
								<td><span><?= $order->utm_term ?></span></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Затраты</h4>
						<table class="block_description">
						<?php $allMinus = 0 ?>
						<?php foreach($actionMinus as $action) { ?>
							<tr>
								<td><?= $function->getDate($action->date) ?></td>
								<td><?= $action->name ?></td>
								<td><?= $action->summa ?></td>
								<td>
									<a href="<?= Yii::$app->urlManager->createUrl(['admin/order', 'id' => $order->id, 'delete' => $action->id]) ?>" class="delete"><img src="/web/images/admin/delete.png" alt="" title="удаление"></a>
								</td>
							</tr>
						<?php $allMinus = $allMinus + $action->summa ?>
						<?php } ?>
							<tr>
								<td><b>Всего</b></td>
								<td><b><?= $allMinus ?></b></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Оплата</h4>
						<table class="block_description">
						<?php $allPlus = 0 ?>
						<?php foreach($actionPlus as $action) { ?>
							<tr>
								<td><?= $function->getDate($action->date) ?></td>
								<td><?= $action->name ?></td>
								<td><?= $action->summa ?></td>
								<td>
									<a href="<?= Yii::$app->urlManager->createUrl(['admin/order', 'id' => $order->id, 'delete' => $action->id]) ?>" class="delete"><img src="/web/images/admin/delete.png" alt="" title="удаление"></a>
								</td>
							</tr>
						<?php $allPlus = $allPlus + $action->summa ?>
						<?php } ?>
							<tr>
								<td><b>Всего</b></td>
								<td><b><?= $allPlus ?></b></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Стоимость работ</h4>
						<table class="block_description">
							<tr>
								<td>Cтоимость</td>
								<td class="edit">
									<span class="edit_span">
										<?= $order->price ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form">
											<input type="text" name="price" value="<?= $order->price ?>" />
											<input type="hidden" name="id" value="<?= $order->id ?>">
											<button name="edit_field">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Оплачено</td>
								<td><?= $allPlus ?><?php if($allPlus != '') { ?> руб.<?php } ?></td>
							</tr>
							<tr>
								<td>Затрачено</td>
								<td><?= $allMinus ?><?php if($allPlus != '') { ?> руб.<?php } ?></td>
							</tr>
							<tr>
								<?php $remainder =  $order->price - $allPlus ?>
								<td>Осталось оплатить</td>
								<td><?= $remainder ?><?php if($remainder != '') { ?> руб.<?php } ?></td>
							</tr>
							<tr>
								<?php $profit = $allPlus - $allMinus ?>
								<td>Прибыль</td>
								<td><span style="font-weight: bold; font-size: 18px; color:#f00"><?= $profit ?><?php if($profit != '') { ?> руб.<?php } ?></span></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Операции</h4>
						<table class="block_description">
							<form action="" method="post">
								<tr>
									<td>Операция</td>
									<td>
										<select name="action">
											<option value="plus">Оплата</option>
											<option value="minus">Затраты</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Наименование</td>
									<td><input type="text" name="action_name" /></td>
								</tr>
								<tr>
									<td>Сумма</td>
									<td><input type="text" name="action_summa" /></td>
								</tr>
								<tr>
									<td colspan="2"><input type="hidden" name="order_id" value="<?= $order->id ?>">
									<button name="add_action" value="true">Добавить</button></td>
								</tr>
							</form>
						</table>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Заказанные товары</h4>
						<table class="block_description">
							<form action="" class="template_form">
								<tr>
									<td>Товар</td>
									<td>Количество</td>
								</tr>
							<?php foreach($ords as $k => $v) { ?>
								<tr>
									<td>
										<a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $k]) ?>">
											<?= $v ?>
										</a>
									</td>
									<td>
										<?= $ord->quan ?>
									</td>
								</tr>
							<?php } ?>
							</form>	
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Комментарий к заявке</h4>
						<table class="block_description">
							<form action="" class="template_form">
								<tr>
									<td>
										<input type="hidden" name="id" value="<?= $order->id ?>">
										<textarea class="comment" rows="8" name="comment">
											<?= $order->comment ?></textarea>
										<button name="edit_field" value="true">Редактировать</button>
									</td>
								</tr>
							</form>	
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>