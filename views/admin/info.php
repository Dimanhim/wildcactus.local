<?php 

namespace app\models;
use yii\widgets\ActiveForm;

use Yii;

use app\components\Functions;

$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Общая информация</h3>
		<p><span style="color: #f00"><?= $message ?></span></p>
		<!--<h3 class="error"></h3>-->
		<div class="container-fluid">
			<div class="row">
				<div class="clearfix">
					<div class="col-md-6">
						<div class="block_info">
							<h4>Загрузить новый логотип</h4>
							<p style="text-align: center; margin-top: 5px;"><img src="/web/images/content/<?= $info->logo ?>" style="width: 100px;" alt="" /></p>

							<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
							    <?= $form->field($logo, 'file')->fileInput() ?>
							    <button>Загрузить</button>
							<?php ActiveForm::end() ?>
						</div>
					</div>
					<div class="col-md-6">
						<div class="block_info">
							<h4>Загрузить новый логотип 2</h4>
							<p style="text-align: center; margin-top: 5px;"><img src="/web/images/content/<?= $info->logo2 ?>" style="width: 100px;" alt="" /></p>

							<?php $form2 = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
							    <?= $form2->field($logo2, 'file')->fileInput() ?>
							    <button>Загрузить</button>
							<?php ActiveForm::end() ?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="block_info">
							<h4>Редактировать информацию</h4>
							<table class="block_description">
								<form class="template_form" action="" method="post">
									<p class="description">Используйте для переноса строки тег &lt;br&gt;</p>
									<tr>
										<td>Цвет текста в шапке</td>
										<td class="radio">
											<p><input type="radio" name="textcolor" <?php if($info->textcolor == 1) { ?>checked <?php } ?>value="1" />Светлый</p>
											<p><input type="radio" name="textcolor" <?php if($info->textcolor == 2) { ?>checked <?php } ?>value="2" />Темный</p>
										</td>
									</tr>
									<tr>
										<td>Дилер</td>
										<td>
											<input type="text" name="diler" value="<?= $info->diler ?>" placeholder="Название дилера" />
										</td>
									</tr>
									<tr>
										<td>Адрес 1</td>
										<td>
											<input type="text" name="adress1" value="<?= $info->adress1 ?>" placeholder="Адрес 1" />
										</td>
									</tr>
									<tr>
										<td>Адрес 2</td>
										<td>
											<input type="text" name="adress2" value="<?= $info->adress2 ?>" placeholder="Адрес 2" />
										</td>
									</tr>
									<tr>
										<td>Телефон 1</td>
										<td>
											<input type="text" name="phone1" value="<?= $info->phone1 ?>" placeholder="Телефон 1" />
										</td>
									</tr>
									<tr>
										<td>Телефон 2</td>
										<td>
											<input type="text" name="phone2" value="<?= $info->phone2 ?>" placeholder="Телефон 2" />
										</td>
									</tr>
									<tr>
										<td>Режим работы</td>
										<td>
											<textarea name="operationmode"><?= $info->operationmode ?></textarea>
										</td>
									</tr>
									<tr>
										<td>Текст футера</td>
										<td>
											<textarea name="footer"><?= $info->footer ?></textarea>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<button name="edit_field" class="edit_field" value="true">Сохранить</button>
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
</div>