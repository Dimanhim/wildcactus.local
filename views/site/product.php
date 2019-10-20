<?php
use app\components\Functions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$functions = new Functions();
$this->title = $product->name;
$parentCat = $functions->getParentCategory($product->id);
$productCat = $functions->getProductCat($product->id);
$this->params['breadcrumbs'][] = array(
   'label'=> $parentCat->name,
   'url'=>Url::toRoute('/'.$parentCat->alias.".html")
);
$this->params['breadcrumbs'][] = array(
   'label'=> $productCat->name,
   'url'=>Url::toRoute('/'.$productCat->alias.".html")
);
$this->params['breadcrumbs'][] = array(
   'label'=> $functions->getShortAlias($product->name), 
   'url'=>Url::toRoute('/'.$product->alias.".html")
);
?>
   <div class="modal fade select-c" id="one-click" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
         <div class="modal-body">
            <h5>
               Заказать<br> <b><?= $product->name ?></b><br>
               через менеджера<br>
               Заполните форму и Ваш заказ будет принят
            </h5>
             <?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'form send-dat']]) ?>
             <?= $form->field($pageForm, 'name', ['template' => "{input}"])->textInput(['placeholder' => "Ваше имя", 'class' => '']) ?>
             <?= $form->field($pageForm, 'phone', ['template' => "{input}"])->textInput(['placeholder' => "Телефон", 'class' => 'phone']) ?>
             <?= $form->field($pageForm, 'plan', ['template' => "{input}"])->textInput(['placeholder' => 'Удобное время для звонка', 'class' => '']) ?>
             <?= $form->field($pageForm, 'btn', ['template' => "{input}"])->hiddenInput(['value' => 'Купить в один клик']) ?>
             <div class="wp-prav">
                 <a href="#" class="privat">Политика обработки персональных данных</a>
             </div>
             <div class="tac">
                 <?= Html::submitButton("<b>Заказать звонок</b>", ['class' => "main-bt green"]) ?>
             </div>
             <?php ActiveForm::end() ?>
            <!--<div class="form">
               <input type="text" placeholder="Ваше имя">
               <input type="text" class="phone" placeholder="Телефон">
               <input type="text" placeholder="Удобное время для звонка">
                <div class="wp-prav">
                    <a href="#" class="privat">Политика обработки персональных данных</a>
                </div>
               <div class="tac">
                  <button class="main-bt green"><b>Заказать звонок</b></button>
               </div>
            </div>-->
         </div>
       </div>
     </div>
   </div>
   <div class="wp-proudct-one">
      <div class="block-info product-page container">
         <h3>
            <i class="icon cases"></i><span><?= $product->name ?></span>
         </h3>
         <div class="in-block-info">
            <div class="row">
               <div class="col-lg-6 col-md-12 clear">
                  <div class="wp-gallery-carousel">
                     <button class="top-arrow"></button>
                     <div class="slick-carousel">
                         <div><img src="<?= PATH.$product->preview ?>" alt=""></div>
                     <?php foreach($images as $image) { ?>
                         <div><img src="<?= PATH.$image->preview ?>" alt=""></div>
                     <?php } ?>
                     </div>
                     <button class="bottom-arrow"></button>
                  </div>
                  <div class="one-img-product f-l">
                      <a href="<?= PATH.$product->img ?>" class="fancy-img">
                          <img src="<?= PATH.$product->preview ?>" alt="">
                      </a>

                  </div>
               </div>
               <div class="col-lg-6 col-md-12 page-product-info">
                  <div class="row">
                     <div class="col-md-8">
                        <div class="specifications">
                           <p><span>серия</span><b><?= $product->series ?></b></p>
                           <p><span>Модель</span><b><?= $product->model ?></b></p>
                           <p><span>Материал</span><b><?= $product->material ?></b></p>
                        </div>
                     </div>
                     <div class="col-md-4 tar">
                     <?php if($product->stock > 0) { ?>
                        <span class="status">Есть в наличии</span>
                     <?php } else { ?>
                        <span class="status red">Нет в наличии</span>
                     <?php } ?>
                        <div class="price-product-page">
                           <?= $product->price ?> р.
                        </div>
                     </div>
                  </div>
                  <div class="wr">
                     <i class="icon warning"></i>
                     <?= $product->description ?>
                  </div>
                  <ul>
                     <li><i class="icon guarantees"></i>Гарантии возврата </li>
                     <li><i class="icon payment"></i>Оплата</li>
                     <li><i class="icon delivery"></i>Доставка</li>
                  </ul>
                  <div class="product-page-count">
                     <i>Добавить</i>
                     <div class="count-product">
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>" data-product="<?= $product->id ?>">
                           <span class="minus">-</span>
                        </a>
                        <b class="item-cart"><?php if($cart->quan) echo $cart->quan; else echo 0 ?></b>
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>" data-product="<?= $product->id ?>">
                           <span class="plus">+</span>
                        </a>
                        <span class="status red cart-message"></span>
                     </div>
                  </div>
                  <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="main-bt green">Купить</a>
                  <a href="#" class="main-bt one-click">Купить в один клик</a>
               </div>
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
                  <?= $hit->name ?>
               </div>
               <div class="image-product">
                  <img src="<?= PATH.$hit->img ?>" alt="">
               </div>
               <div class="price-product"><?= $hit->price ?> р.</div>
               <div class="tac">
                  <?php if(!$functions->isProductInCart($hit->id)) { ?>
                  <a href="<?= Yii::$app->urlManager->createUrl(['site/addtocart', 'id' => $hit->id]) ?>"  data-product="<?= $hit->id ?>" class="buy-product">В корзину</a>
                  <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $hit->id]) ?>">Подробнее</a>
               <?php } else { ?>
                  <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="buy-product product-in-cart">Добавлен</a>
                  <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $hit->id]) ?>">Подробнее</a>
               <?php } ?>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </div>
<?php } ?>
