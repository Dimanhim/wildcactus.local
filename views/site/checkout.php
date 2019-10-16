<?php
use app\components\Functions;
use yii\helpers\Url;
$functions = new Functions();
$this->title = "Оформление заказа";
$this->params['breadcrumbs'][] = array(
   'label'=> "Оформление заказа", 
   'url'=>Url::toRoute("/checkout.html")
);
?>
   <div class="block-info wp-contacts container">
      <h3>
         <span>оформление заказа </span> <i class="icon write"></i>
      </h3>
      <div class="in-block-info ordering">
         <div class="row">
            <div class="col-lg-6 col-md-12 br">
               <table class="cart">
               <?php foreach($carts as $cart) { ?>
               <?php $product = $functions->getProductFromCart($cart->product) ?>
                  <tr class="cart-tr cart-tr-border" data-product="<?= $product->id ?>">
                     <td class="img-cart-product">
                        <img src="<?= PATH.$product->img ?>" alt="" />
                        <span class="price-product-ch now-price"><i><?= $product->price ?></i>р.</span>
                     </td>
                     <td class="now-price" style="display: none">
                        <i><?= $product->price ?></i>р.
                     </td>
                     <td class="title-cart-product">
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>"><?= $functions->getShortAlias($product->name) ?></a>
                        <div class="more-product-ch">
                           <div class="count-product">
                              
                              <b><?= $cart->quan ?></b>
                              
                           </div>
                           <div class="total-price-cart">
                              <i><?= $product->price ?></i>р.
                           </div>
                        </div>
                     </td>
                  </tr>
               <?php } ?>
               </table>

               <div class="ordering-info-total">
                  <p><span>Итого</span><b class="mini"><i class="total-ch">0</i></b></p>
                  <p class="middle-n"><span>Стоимость доставки</span><b><i class="price-dev" id="price-dev">укажите город</i></b></p>
                  <p><span>к оплате</span><b><i class="topay"></i></b></p>
               </div>

            </div>
            <div class="col-lg-6 col-md-12 bl-green">
               <!--<form action="." class="form">
                  <div class="row">
                     <div class="col-md-12">
                        <input type="text" placeholder="Фамилия  Имя  Отчество">
                     </div>
                     <div class="col-md-6">
                        <input type="text" placeholder="Телефон ">
                     </div>
                     <div class="col-md-6">
                        <input type="text" placeholder="E-mail">
                     </div>
                     <div class="col-md-12">
                        <input type="text" class="un-m" placeholder="Дополнительная информация">
                     </div>
                  </div>
-->

                  <h3><i class="icon delivery"></i>Доставка</h3>
                  <div class="row">
                     <div class="col-md-4">
                        <label for="n1">Почта России</label>
                        <div class="wp-radio">
                           <input type="radio" name="delivery" id="n1">
                           <label for="n1" id="mail-btn"></label>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <label for="n2">Транспортная компания СДЭК</label>
                        <div class="wp-radio">
                           <input type="radio" name="delivery" id="n2" checked>
                           <label for="n2" id="sdek-btn"></label>
                        </div>
                     </div>
                  </div>
               </form>

                  <div class="mail-form">
                       <div class="form">
                           <input id="city-mail" class="deliv" placeholder="Введите почтовый индекс доставки" />
                            <br />
                       </div>
                       <?php require_once "form-mail.php"?>
                  </div>
                <div class="sdek">
                    <div class="ui-widget form">
                        <input id="city" class="deliv" placeholder="Введите адрес доставки" />
                        <br />
                    </div>
                    <?php require_once "form-sdek.php"?>
                </div>

                  <div class="row">
                     <div class="col-md-7"><h3><i class="icon payment"></i>Онлайн оплата картой</h3></div>
                     <div class="col-md-5"><img class="payment-type" src="/web/images/icons/payment_types@2x.png" alt=""></div>
                  </div>
                  <p class="sub">
                     * Нажимая на кнопку ОФОРМИТЬ ЗАКАЗ, я даю согласие на обработку персональных данных
                  </p>
                <?php require_once "tinkoff_2.php" ?>
                  

            </div>
         </div>
      </div>
   </div>

