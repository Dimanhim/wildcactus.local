<?php
use app\components\Functions;
use yii\helpers\Url;
$functions = new Functions();
$this->title = $cat->name;
$parentCategory = $functions->getCatParentCategory($cat->id);
if($cat->level != 1) {
   $this->params['breadcrumbs'][] = array(
      'label'=> $parentCategory->name,
      'url'=>Url::toRoute('/'.$parentCategory->alias.".html")
   );
}
$this->params['breadcrumbs'][] = array(
   'label'=> $cat->name, 
   'url'=>Url::toRoute('/'.$cat->alias.".html")
);
?>
   <div class="wp-my-cart">
      <div class="block-info container">
         <h3>
            <span><?= $cat->name ?> </span> <i class="icon cases"></i>
         </h3>
         <?php if($cat->level == 1) { ?>
         <div class="filt">
            <div class="row wp-products">
            <?php foreach($categories as $category) { ?>
               <div class="col-lg-3 col-md-4 col-sm-6">
                 <div class="product-on">
                    <div class="title-product">
                       <a href="<?= Yii::$app->urlManager->createUrl(['site/category', 'id' => $category->id]) ?>" class="a-item">
                         <?= $category->name ?>
                       </a>
                    </div>
                    <div class="image-product">
                     <?php if($category->img) { ?>
                       <a href="<?= Yii::$app->urlManager->createUrl(['site/category', 'id' => $category->id]) ?>" class="a-item">
                         <img src="<?= PATH.$category->img ?>" alt="">
                       </a>
                     <?php } ?>
                    </div>
                 </div>
              </div>
            <?php } ?>
            </div>
         </div>
         <?php } else { ?>
         <div class="row wp-products">
            <?php foreach($products as $product) { ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
               <div class="product-on">
                  <div class="title-product">
                      <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>" class="a-item">
                        <?= $product->name ?>
                      </a>
                  </div>
                  <div class="image-product">
                      <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>" class="a-item">
                        <img src="<?= PATH.$product->img ?>" alt="">
                      </a>
                  </div>
                  <div class="price-product"><?= $product->price ?> р.</div>
                  <div class="tac">
                  <?php if(!$functions->isProductOnStock($product->id)) { ?>
                     <span class="unclickable">Нет в наличии</span>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>">Подробнее</a>
                  <?php } elseif(!$functions->isProductInCart($product->id)) { ?>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/addtocart', 'id' => $product->id]) ?>"  data-product="<?= $product->id ?>" class="buy-product add-to-cart">В корзину</a>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>">Подробнее</a>
                  <?php } else { ?>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>" class="buy-product product-in-cart">Купить</a>
                     <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>">Подробнее</a>
                  <?php } ?>
                  </div>
               </div>
            </div>
            <?php } ?>
         </div>
         <?php } ?>
      </div>
      <div class="block-info product-info-page">
         <div class="container info-page">
            <div class="row">
               <div class="col-md-12">
                  <h4><?= $pageMain->header_product ?></h4>

                  <p>
                     <?= $pageMain->header_product ?>
                  </p>
               </div>
            </div>
         </div>
      </div>
   </div>
   
