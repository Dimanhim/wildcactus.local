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
		<h3>Администратор</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Информация об администраторе</h4>
						<table class="block_description">
							<tr>
								<td>Имя</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->name ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="name" value="<?= $options->name ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Email (для заявок)</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->email ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="email" value="<?= $options->email ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Логин</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->login ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="login" value="<?= $options->login ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Количество заявок на странице</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->count ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="count" value="<?= $options->count ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Показывать заявок за период</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->period ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="period" value="<?= $options->period ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Имя отправителя почты</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->mailname ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="mailname" value="<?= $options->mailname ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Название split шаблона (А)</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->split1 ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="split1" value="<?= $options->split1 ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td>Название split шаблона (Б)</td>
								<td class="edit">
									<span class="edit_span">
										<?= $options->split2 ?>
									</span>
									<span class="edit_form">
										<form action="" class="template_form" method="post">
											<input type="text" name="split2" value="<?= $options->split2 ?>" />
											<button name="edit_field" value="true">ОК</button>
										</form>	
									</span>
								</td>
								<td class="edit_button"><a href=""><img src="/web/images/admin/edit.png" alt=""></a></td>
							</tr>
							<tr>
								<td colspan="3"><p style="text-align: center">Сменить пароль</p></td>
							</tr>
							<form action="" class="template_form" method="post">
							<tr>
								<td colspan="3">
									<input type="password" name="password" placeholder="Новый пароль" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<input type="password" name="password2" placeholder="Новый пароль еще раз" />
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<button name="change_pass" value="true">Сменить пароль</button>
								</td>
							</tr>
							</form>	
						</table>
					</div>
				</div>
				<div class="col-md-6">
					<div class="block_info">
						<h4>Информация об администраторе</h4>
						<table class="block_description">
						<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'send-data']]) ?>
							<tr>
								<td>Email (на сайте)</td>
								<td>
									<?= $form->field($infoForm, 'siteemail', ['template' => "{input}"])->textInput(['value' => $options->siteemail]) ?>
								</td>
							</tr>
							<tr>
								<td>Телефон</td>
								<td>
									<?= $form->field($infoForm, 'phone', ['template' => "{input}"])->textInput(['value' => $options->phone]) ?>
								</td>
							</tr>
							<tr>
								<td>Реквизиты</td>
								<td>
									<?= $form->field($infoForm, 'req', ['template' => "{input}"])->textarea(['value' => $options->req]) ?>
								</td>
							</tr>
							<tr>
								<td>Адрес страницы в Инстаграм</td>
								<td>
									<?= $form->field($infoForm, 'insta', ['template' => "{input}"])->textInput(['value' => $options->insta]) ?>
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
			</div>
		</div>
	</div>
</div>