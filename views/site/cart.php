<?php
use app\components\Functions;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$functions = new Functions();
$this->title = "Корзина";
$this->params['breadcrumbs'][] = array(
   'label'=> "Корзина", 
   'url'=>Url::toRoute("/cart.html")
);
?>
   <div class="modal fade select-c" id="one-click" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
         <div class="modal-body">
            <h5>
               Заполните форму и Ваш заказ будет принят
            </h5>
               <?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'form send-cart']]) ?>
                  <?= $form->field($pageForm, 'name', ['template' => "{input}"])->textInput(['placeholder' => "Ваше имя", 'class' => '']) ?>
                  <?= $form->field($pageForm, 'phone', ['template' => "{input}"])->textInput(['placeholder' => "Телефон", 'class' => 'phone']) ?>
                  <?= $form->field($pageForm, 'plan', ['template' => "{input}"])->textInput(['placeholder' => 'Удобное время для звонка', 'class' => '']) ?>
                  <div class="wp-prav">
                     <div class="wp-radio">
                        <input type="checkbox" name="delivery" id="n50">
                        <label for="n50"></label>
                     </div>
                     <label for="n50" class="p">Я согласен с <span>политикой обработки персональных данных</span></label>
                  </div>
                  <div class="tac">
                     <?= Html::submitButton("<b>Заказать звонок</b>", ['class' => "main-bt green"]) ?>
                  </div>
                  <label for="n50" class="p">Я согласен с <span>политикой обработки персональных данных</span></label>
            <?php ActiveForm::end() ?>
         </div>
       </div>
     </div>
   </div>
   <div class="wp-my-cart">
      <div class="block-info container">
         <h3>
            <span>Моя корзина</span> <i class="icon cart"></i>
         </h3>
         <div class="in-block-info">
            <table class="cart">
            <?php foreach($carts as $cart) { ?>
               <?php $product = $functions->getProductFromCart($cart->product) ?>
               <tr class="cart-tr" data-product="<?= $product->id ?>">
                  <td class="img-cart-product">
                     <span class="product-id"><?= $product->id ?></span>
                     <img src="<?= PATH.$product->img ?>" alt="">
                  </td>
                  <td class="title-cart-product">
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>"><?= $functions->getShortAlias($product->name) ?></a>
                  </td>
                  <td class="now-price">
                     <i><?= $product->price ?></i>р.
                  </td>
                  <td>
                     <div class="count-product">
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" data-product="<?= $product->id ?>">
                           <span class="minus">-</span>
                        </a>
                        <b><?= $cart->quan ?></b>
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" data-product="<?= $product->id ?>">
                           <span class="plus">+</span>
                        </a>
                     </div>
                  </td>
                  <td class="total-price-cart">
                     <i><?= $product->price ?></i>р.
                  </td>
                  <td>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="delete-product" data-product-id="<?= $product->id ?>"><i class="icon trashcan"></i></a>
                  </td>
               </tr>
            <?php } ?>
            </table>
            <div class="total-price">
               <span>ИТОГО</span> <b><i></i>р.</b>
            </div>
            <div class="tac">
               <a href="#"  onClick="history.back();" class="main-bt">Вернуться назад</a>
               <a href="<?= Yii::$app->urlManager->createUrl(['site/checkout']) ?>" class="main-bt green checkout">Оформить заказ</a>    
               <a href="#" class="main-bt one-click">Купить в один клик</a> 
            </div>
         </div>
      </div>
   </div>
<?php if($hits->count() > 0) { ?>
   <div class="wp-slider-product container block-info">
      <h3>
         <span>хиты продаж</span> <i class="icon fire"></i>
         <a href="#" class="owl-tr tr-prev" data-id-owl="ds1"></a>
         <a href="#" class="owl-tr tr-next" data-id-owl="ds1"></a>
      </h3> 
      <div class="owl-carousel slider-product owl-theme" id="ds1">
         <?php foreach($hits->all() as $hit) { ?>
         <div>
            <div class="product-on">
               <div class="title-product">
                <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $hit->id]) ?>" class="a-item">
                  <?= $hit->name ?>
                </a>
               </div>
               <div class="image-product">
                <?php if($hit->img) { ?>
                  <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $hit->id]) ?>" class="a-item">
                    <img src="<?= PATH.$hit->img ?>" alt="">
                  </a>
                <?php } ?>
               </div>
               <div class="price-product"><?= $hit->price ?> р.</div>
               <div class="item-product">
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" data-product="<?= $hit->id ?>" data-product="<?= $hit->id ?>">
                       <span class="minus">-</span>
                    </a>
                    <b><?= $functions->quanProductInCart($hit->id) ?></b>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" data-product="<?= $hit->id ?>" data-product="<?= $hit->id ?>">
                       <span class="plus">+</span>
                    </a>
               </div>
               <div class="tac">
               <?php if(!$functions->isProductOnStock($hit->id)) { ?>
                     <span class="unclickable">Нет в наличии</span>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $hit->id]) ?>">Подробнее</a>
                  <?php } elseif(!$functions->isProductInCart($hit->id)) { ?>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/addtocart', 'id' => $hit->id]) ?>"  data-product="<?= $hit->id ?>" class="buy-product add-to-cart">В корзину</a>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $hit->id]) ?>">Подробнее</a>
                  <?php } else { ?>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="buy-product product-in-cart">Купить</a>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $hit->id]) ?>">Подробнее</a>
                  <?php } ?>
                  
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </div>
<?php } elseif($news->count() > 0) { ?>
   <div class="wp-slider-product container news">
      <h3>
         <span>новинки</span> <i class="icon fire"></i>
         <a href="#" class="owl-tr tr-prev" data-id-owl="ds1"></a>
         <a href="#" class="owl-tr tr-next" data-id-owl="ds1"></a>
      </h3> 
      <div class="owl-carousel slider-product owl-theme" id="ds1">
        <?php foreach($news->all() as $new) { ?>
          <div>
             <div class="product-on">
                <div class="title-product">
                   <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $new->id]) ?>" class="a-item">
                     <?= $new->name ?>
                   </a>
                </div>
                <div class="image-product">
                 <?php if($new->img) { ?>
                   <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $new->id]) ?>" class="a-item">
                     <img src="<?= PATH.$new->img ?>" alt="">
                   </a>
                 <?php } ?>
                </div>
                <div class="price-product"><?= $new->price ?> р.</div>
                <div class="item-product">
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" data-product="<?= $new->id ?>" data-product="<?= $new->id ?>">
                       <span class="minus">-</span>
                    </a>
                    <b><?= $functions->quanProductInCart($new->id) ?></b>
                    <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" data-product="<?= $new->id ?>" data-product="<?= $new->id ?>">
                       <span class="plus">+</span>
                    </a>
               </div>
                <div class="tac">
                <?php if(!$functions->isProductOnStock($new->id)) { ?>
                     <span class="unclickable">Нет в наличии</span>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $new->id]) ?>">Подробнее</a>
                  <?php } elseif(!$functions->isProductInCart($product->id)) { ?>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/addtocart', 'id' => $new->id]) ?>"  data-product="<?= $new->id ?>" class="buy-product add-to-cart">В корзину</a>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $new->id]) ?>">Подробнее</a>
                  <?php } else { ?>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="buy-product product-in-cart">Купить</a>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $new->id]) ?>">Подробнее</a>
                  <?php } ?>
                </div>
             </div>
         </div>
        <?php } ?>
      </div>
   </div>

<?php } ?>
