<?php 

namespace app\models;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use Yii;

use app\components\Functions;

$function = new Functions();
?>
							<table class="block_description">
									<tr>
										<td>Количество на складе</td>
										<td>
											<b><?= $product->stock ?></b>
										</td>
									</tr>
									<tr>
										<td>Штрих-код</td>
										<td>
											<?= $product->barcode ?>
										</td>
									</tr>
									<tr>
										<td>Сортировка</td>
										<td>
											<?= $product->orderby ?>
										</td>
									</tr>
									<tr>
										<td>Основное изображение</td>
										<td class="cat_main_img">
											<img src="<?= PATH.$product->img ?>" >
										</td>
									</tr>
									<tr>
										<td>Название</td>
										<td>
											<?= $product->name ?>
										</td>
									</tr>
									<tr>
										<td>Описание</td>
										<td>
											<?= $product->description ?>
										</td>
									</tr>
									<tr>
										<td>Алиас (ссылка)</td>
										<td>
											<?= $product->alias ?>
										</td>
									</tr>
									<tr>
										<td>Серия</td>
										<td>
											<?= $product->series ?>
										</td>
									</tr>
									<tr>
										<td>Модель</td>
										<td>
											<?= $product->model ?>
										</td>
									</tr>
									<tr>
										<td>Материал</td>
										<td>
											<?= $product->material ?>
										</td>
									</tr>
									<tr>
										<td>Цена</td>
										<td>
											<?= $product->price ?>
										</td>
									</tr>
									<tr>
										<td>Категория</td>
										<td>
											<?= $product->category ?>
										</td>
									</tr>
									<tr>
										<td>Хит продаж</td>
										<td>
											<?= $product->hit ?>
										</td>
									</tr>
									<tr>
										<td>Новинка</td>
										<td>
											<?= $product->new ?>
										</td>
									</tr>
									<tr>
										<td>Публикация</td>
										<td>
											<?= $product->status ?>
										</td>
									</tr>
									<tr>
										<td>Участие в акции</td>
										<td>
											<?= $product->promo ?>
										</td>
									</tr>
									<tr>
										<td colspan="2"><a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>" class="link_btn">Перейти</a></td>
									</tr>
							</table>