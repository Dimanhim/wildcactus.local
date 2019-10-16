<?php 

namespace app\models;

use Yii;
use app\components\Functions;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$count = 1;
$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
   <div class="menu">
      <h3>Товары</h3>
      <p class="success_message"><?= $message ?></p>
      <div class="col-md-12">
         <table class="table">
            <tr class="header_tr">
               <td>№</td>
               <td>Сортировка</td>
               <td>Изображение</td>
               <td>Название</td>
               <td>Категория</td>
               <td>Статус</td>
               <td>Хит продаж</td>
               <td>Новинка</td>
               <td>Участвует в акции</td>
               <td>Общее количество на складе</td>
               <td>Зарезервировано</td>
               <td>Ожидает отправки</td>
               <td>Функции</td>
            </tr>
         <?php foreach($products as $product) { ?>
            <tr>
               <td><?=$count?></td>
               <td><?=$product->orderby?></td>
               <td class="cat-img">
                  <a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product->id]) ?>">
                     <img src="<?= PATH.$product->img ?>" alt="" />
                  </a>
               </td>
               <td><a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product->id]) ?>"><?=$product->name?></a></td>
               <td>
                        <?php //if($productcats) { ?>
                            <?php foreach($productcats->where(['product' => $product->id])->all() as $productcat) { ?>
                            <a href="<?= Yii::$app->urlManager->createUrl(['admin/category', 'id' => $productcat->category]) ?>">
                                <?= $function->getParentCategoryName($productcat->category)?>
                            </a><br />
                            <?php } ?>
                        <?php //} ?>
                    </td>
               <td><?= $function->getStatusByNumber($product->status)?></td>
               <td><?= $function->isHitProduct($product->hit)?></td>
               <td><?= $function->isNewProduct($product->new)?></td>
               <td>
               <?php if($product->promo) { ?>
                  <a href="<?= Yii::$app->urlManager->createUrl(['admin/promo', 'id' => $product->promo]) ?>">
                     <?= $function->isProductPromo($product->promo) ?>
                  </a>
               <?php } else { ?>
                  <?= $function->isProductPromo($product->promo) ?>
               <?php } ?>
               </td>
               <td><b><?=$product->stock?></b></td>
               <td><b><?= $function->getStockProducts($product->id, 1)?></b></td>
               <td><b><?= $function->getStockProducts($product->id, 2)?></b></td>
               <td>
                  <a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product->id]) ?>"><img src="/web/images/admin/view.png" alt="" title="просмотр"></a>
               <?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'delete_form']]) ?>
               <?= $form->field($blockForm, 'id', ['template' => "{input}"])->hiddenInput(['value' => $product->id]) ?>
               <?= Html::submitButton("<img src='/web/images/admin/delete.png' alt='' title='удаление'>", ['class' => 'delete']) ?>
               <?php ActiveForm::end() ?>
               </td>
            </tr>
            <?php $count++ ?>
         <?php } ?>
         </table> 
      </div>
      
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-md-offset-4">
               <a href="<?= Yii::$app->urlManager->createUrl(['admin/addproduct']) ?>" class="link_btn">Добавить товар</a>
            </div>
         </div>
      </div>
      
   </div>
</div>
<script>
</script>
