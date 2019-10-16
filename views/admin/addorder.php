<?php 

namespace app\models;

use Yii;

use app\components\Functions;

$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Добавление нового заказа</h3>
		<p><span style="color: #f00"><?= $message ?></span></p>
		<div class="container-fluid">
			<div class="row">
				<form action="" method="get">
					<div class="clearfix">
						<div class="col-md-6">
							<div class="block_info">
								<h4>Информация о заявке</h4>
								<table class="block_description">
									<tr>
										<td>Имя</td>
										<td>
											<input type="text" name="name" />
										</td>
									</tr>
									<tr>
										<td>Номер телефона</td>
										<td>
											<input type="text" name="phone" />
										</td>
									</tr>
									<tr>
										<td>Email</td>
										<td>
											<input type="text" name="email" />
										</td>
									</tr>
									<tr>
										<td>Стоимость</td>
										<td>
											<input type="text" name="price" />
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
										<td>Откуда пришел</td>
										<td>
											<input type="hidden" name="utm_source" value="добавлен вручную" />
											<span>добавлен вручную</span>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<button name="new_order" class="add_order">Добавить заявку</a>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	jQuery('.edit_button a img').on('click', function() {
		jQuery(this).parent('a').parent('td').parent('tr').children('td.edit').children('span.edit_span').css('display', 'none');
		jQuery(this).parent('a').parent('td').parent('tr').children('td.edit').children('span.edit_form').css('display', 'block');
		return false;
	});
	<?php //if($request['new_order'] == "success") { ?>
	/*$(function() {
		alert('Заявка успешно добавлена');
	});*/
	<?php //} ?>
</script>