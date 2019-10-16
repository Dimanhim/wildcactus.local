<?php 

namespace app\models;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

use Yii;

use app\components\Functions;

$function = new Functions();
?>
<?php print_r($c) ?>
							<table class="block_description">
								<?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]]]) ?>
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
											<?= $form->field($blockForm, 'orderby', ['template' => "{input}"])->textInput(['value' => $product->orderby]) ?>
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
											<?= $form->field($blockForm, 'name', ['template' => "{input}"])->textarea(['value' => $product->name]) ?>
										</td>
									</tr>
									<tr>
										<td>Описание</td>
										<td>
											<?= $form->field($blockForm, 'description', ['template' => "{input}"])->textarea(['value' => $product->description]) ?>
										</td>
									</tr>
									<tr>
										<td>Алиас (ссылка)</td>
										<td>
											<?= $product->alias ?>
											<?//= $form->field($blockForm, 'alias', ['template' => "{input}"])->textInput(['value' => $product->alias]) ?>
										</td>
									</tr>
									<tr>
										<td>Серия</td>
										<td>
											<?= $form->field($blockForm, 'series', ['template' => "{input}"])->textInput(['value' => $product->series]) ?>
										</td>
									</tr>
									<tr>
										<td>Модель</td>
										<td>
											<?= $form->field($blockForm, 'model', ['template' => "{input}"])->textInput(['value' => $product->model]) ?>
										</td>
									</tr>
									<tr>
										<td>Материал</td>
										<td>
											<?= $form->field($blockForm, 'material', ['template' => "{input}"])->textInput(['value' => $product->material]) ?>
										</td>
									</tr>
									<tr>
										<td>Цена</td>
										<td>
											<?= $form->field($blockForm, 'price', ['template' => "{input}"])->textInput(['value' => $product->price]) ?>
										</td>
									</tr>
									<tr>
										<td>Категория</td>
										<?php
											foreach($categories as $category) {
												if($category->level != 2) {
													$items[$category->name] = [];
													foreach($categories as $cat) {
														if($cat->parent == $category->id) {
															$items[$category->name][$cat->id] = $cat->name;
														}
													}
												}
											}
											$array = array();
                                            foreach($cats as $cat) {
                                                $array[$cat->category] = ['Selected' => 'selected'];
                                            }
									    	$param = [
									    		'options' => $array,
                                                'prompt' => 'Выбрать...',
                                                'multiple' => 'multiple',
                                                'class' => 'form-control select-cat',
									    	];
									    ?>
										<td>
											<?= $form->field($blockForm, 'category')->dropDownList($items, $param); ?>
										</td>
									</tr>
									<tr>
										<td>Хит продаж</td>
										<?php
											
											$items = [
												'1' => 'Да',
												'0' => 'Нет',
												
											];
									    	$param = [
									    		'options' => [ 
									    			$product->hit => [
									    				'Selected' => true
									    			]
									    		],
									    		'prompt' => 'Выбрать...'
									    	];
									    ?>
										<td>
											<?= $form->field($blockForm, 'hit')->dropDownList($items, $param); ?>
										</td>
									</tr>
									<tr>
										<td>Новинка</td>
										<?php
											
											$items = [
												'1' => 'Новый',
												'0' => 'Не новый',
												
											];
									    	$param = [
									    		'options' => [ 
									    			$product->new => [
									    				'Selected' => true
									    			]
									    		],
									    		'prompt' => 'Выбрать...'
									    	];
									    ?>
										<td>
											<?= $form->field($blockForm, 'new')->dropDownList($items, $param); ?>
										</td>
									</tr>
									<tr>
										<td>Публикация</td>
										<?php 
									    	$items = [
										    	'1' => 'Опубликовано',
										    	'0' => 'Не опубликовано',
									    	];
									    	$param = ['options' =>[ $product->status => ['Selected' => true]]];
									    ?>
										<td>
											<?= $form->field($blockForm, 'status')->dropDownList($items, $param); ?>
										</td>
									</tr>
									<tr>
										<td>Участие в акции</td>
										<?php
										$items = array();
											foreach($promos as $promo) {
												$items[$promo->id] = $promo->name;
											}
									    	$param = [
									    		'options' => [
									    			$product->promo => [
									    				'Selected' => true
									    			]
									    		],
									    		'prompt' => 'Выбрать...'
									    	];
									    ?>
										<td>
											<?= $form->field($blockForm, 'promo')->dropDownList($items, $param); ?>
										</td>
									</tr>
									<tr>
										<td>Загрузить основное изображение товара</td>
										<td>
											<?= $form->field($blockForm, 'file')->fileInput() ?>
											<?= $form->field($blockForm, 'id')->hiddenInput(['value' => $product->id]) ?>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<?= Html::submitButton('Сохранить', ['class' => 'link_btn']) ?>
										</td>
									</tr>
								<?php ActiveForm::end() ?>
							</table>