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
		<h3>Найти товар в базе</h3>
		<p class="success_message"><?= $message ?></p>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="block_info">
						<h4>Товар по штрих-коду</h4>
						<table class="block_description">
							<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
								<tr>
									<td>Штрих-код</td>
									<td>
										<?= $form->field($addForm, 'barcode', ['template' => "{input}"])->textInput(['autofocus' => 'autofocus']) ?>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<?= Html::submitButton('Найти') ?>
									</td>
								</tr>
							<?php ActiveForm::end() ?>
						</table>
					</div>
				</div>
                <div class="col-md-6">
                    <div class="block_info">
                        <h4>Товар по ключевым словам</h4>
                        <table class="block_description">
                            <?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
                            <tr>
                                <td>Слово</td>
                                <td>
                                    <?= $form->field($searchProduct, 'name', ['template' => "{input}"])->textInput(['autofocus' => 'autofocus']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <?= Html::submitButton('Найти') ?>
                                </td>
                            </tr>
                            <?php ActiveForm::end() ?>
                        </table>
                    </div>
                </div>

			<?php if($product) { ?>
				<div class="col-md-6">
					<div class="block_info">
						<h4><b><?= $product->name ?></b></h4>
                        <?php
                            if ($pages == "barcode") require_once "view-product.php";
                            elseif ($pages == "names") require_once "view-product-2.php"
                        ?>
					</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
