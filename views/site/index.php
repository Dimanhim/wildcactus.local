<?php
use app\components\Functions;
$functions = new Functions();
$this->title = $page->title;
//$this->metaTags->metadesc = $page->metadesc;
$this->registerMetaTag(['name' => 'description ', 'content' => $page->metadesc]);
?>
    <div class="top-slider">
        <h1 class="hidden-xs">Чехлы и аксессуары <br />для Apple</h1>
        <div class="owl-carousel top-cover owl-theme">
            <?php foreach($promos as $promo) { ?>
                <?php if($promo->status == 1) { ?>
                    <div>
                        <img src="<?= PATH.$promo->img ?>" alt="">
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>

<?php if($news->count() > 0) { ?>

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
                  <?php } elseif(!$functions->isProductInCart($new->id)) { ?>
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
<?php if($hits->count() > 0) { ?>

   <div class="wp-slider-product container">
      <h3>
         <span>хиты продаж</span> <i class="icon fire"></i>
         <a href="#" class="owl-tr tr-prev" data-id-owl="ds2"></a>
         <a href="#" class="owl-tr tr-next" data-id-owl="ds2"></a>
      </h3> 
      <div class="owl-carousel slider-product owl-theme" id="ds2">
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

<?php } ?>
<?php if($banners->count() > 0) { ?>
   <div class="wp-stock container">
      <h3>
         <a href="<?= Yii::$app->urlManager->createUrl(['site/promos']) ?>" class="promos"><span>Акции</span></a> <i class="icon star"></i>
         <a href="#" class="owl-tr tr-prev" data-id-owl="owl-stock"></a>
         <a href="#" class="owl-tr tr-next" data-id-owl="owl-stock"></a>
      </h3>
      <div class="owl-carousel owl-stock owl-theme" id="owl-stock">
        <?php foreach($banners->all() as $banner) { ?>
          <?php if($banner->status == 1) { ?>
         <div>
            <img src="<?= PATH.$banner->img ?>" alt="">
         </div>
         <?php } ?>
        <?php } ?>
      </div>
   </div>
<?php } ?>

   <div class="wp-about" id="about">
      <div class="container">
         <h5><?= $page->header ?></h5>
         <p>
            <?= $page->about ?>
            <br>
            <b><?= $page->text ?></b>
         </p>
         <h4><?= $page->adv ?></h4>

         <div class="row mb35">
            <div class="col-xl-4 col-lg-4">
               <div class="block-about" data-count="1">
                  <h6><?= $adv->a1h ?></h6>
                  <p>
                     <?= $adv->a1t ?>
                  </p>
               </div>
            </div>
            <div class="col-xl-5 col-lg-4">
               <div class="block-about" data-count="2">
                  <h6><?= $adv->a2h ?></h6>
                  <p>
                     <?= $adv->a2t ?>
                  </p>
               </div>
            </div>
            <div class="col-xl-3 col-lg-4">
               <div class="block-about" data-count="3">
                  <h6><?= $adv->a3h ?></h6>
                  <p>
                     <?= $adv->a3t ?>
                  </p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-4 col-lg-4">
               <div class="block-about" data-count="4">
                  <h6><?= $adv->a4h ?></h6>
                  <p>
                     <?= $adv->a4t ?>
                  </p>
               </div>
            </div>
            <div class="col-xl-5 col-lg-4">
               <div class="block-about" data-count="5">
                  <h6>
                     <?= $adv->a5h ?>
                  </h6>
                  <p>
                     <?= $adv->a5t ?>
                  </p>
               </div>
            </div>
            <div class="col-xl-3 col-lg-4">
               <div class="block-about" data-count="6">
                  <h6><?= $adv->a6h ?></h6>
                  <p>
                     <?= $adv->a6t ?>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
