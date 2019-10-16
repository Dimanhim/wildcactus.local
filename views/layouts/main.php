
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use app\models\Categories;
use app\models\Cart;
use app\models\Users;
use app\models\Options;
use app\components\Functions;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
$functions = new Functions();
$session = Yii::$app->session;
if(!$session->has('userIp')) {
   $session->set('userIp', USERIP);
}
$userIp = $session->get('userIp');
$functions->deleteOldUsers();
$cart = Cart::find()->where(['user' => $userIp])->count();
$cartPrice = $functions->getSummaCart($userIp);
$categories = Categories::find()->where(['status' => 1])->orderby('orderby')->all();
$options = Options::find()->one();
$activePage = Yii::$app->controller->action->id;
if(Users::find()->where(['user' => $userIp])->one()) $users = Users::find()->where(['user' => $userIp])->one();
else {
    $users = new Users();
    $users->user = $userIp;
    $users->date = time();
    $users->save();
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?= Html::csrfMetaTags() ?>
   <?php $this->head() ?>

   <title><?= Html::encode($this->title) ?></title>
   <!-- css -->
   <link href="/web/css/libs.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
   <link type="text/css" href="/web/css/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
   <link href="/web/css/jquery.fancybox.min.css" rel="stylesheet">
   <link href="/web/css/main.css" rel="stylesheet">
   <link href="/web/favicon.ico" rel="shortcut icon" type="image/x-icon" />
   <script language=JavaScript>
            <!--
      var message="Правый клик запрещен!";
      ///////////////////////////////////
      /*
            function clickIE4(){
            if (event.button==2){
            //alert(message);
            return false;
            }
            }
      function clickNS4(e){
            if (document.layers||document.getElementById&&!document.all){
            if (e.which==2||e.which==3){
            //alert(message);
            return false;
            }
            }
            }
      if (document.layers){
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown=clickNS4;
            }
            else if (document.all&&!document.getElementById){
            document.onmousedown=clickIE4;
            }
      document.oncontextmenu=new Function("return false")
      */
      // --> 
      </script>
   <!--<script src="//api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>-->

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->
</head>
<body>
<!--<h1 id="testArea"></h1>
<h1 id="resArea"></h1>-->

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(54477790, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/54477790" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

   <!-- MODALS -->



<!--  Виджет модального окна заполнения заявки  -->
  <?=\app\widgets\mail\MailWidget::widget()?>
   <div class="modal fade privat-c" id="privat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
         <div class="modal-body">
            <h5 class="priv">Конфиденциальность и защита персональной информации</h5>
            <p>
               Настоящий документ (далее «Политика») описывает условия обработки персональных данных, передаваемых вами в качестве субъекта персональных данных (далее «Субъект ПД») в адрес ИП Ферсенко Юлия Юрьевна в качестве оператора персональных данных (далее «Оператор ПД»). Положения Политики действуют только при посещении Субъектом ПД интернет-сайта Оператора ПД. <br>
               1. Обработка и защита персональных данных  <br>
               1.1. Оператор ПД может осуществлять сбор, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, блокирование, удаление персональных данных Субъекта ПД в соответствии с действующим законодательством РФ: ст. 24 Конституции Российской Федерации, ст. 6 Федерального закона №152-ФЗ «О персональных данных» и Гражданским кодексом Российской Федерации в рамках исполнения договора купли-продажи. <br> 
               1.2. Обработка и хранение персональных данных осуществляются в электронном виде с использованием средств автоматизации с обеспечением конфиденциальности и соблюдением положений о защите персональных данных, предусмотренных законодательством РФ.  <br>
               1.3. Условия передачи персональных данных: - Субъект ПД должен подтвердить свое согласие на обработку персональных данных, передаваемых через любые веб-формы на сайте Оператора ПД, либо путем заполнения специального поля перед отправкой персональных данных, либо самим фактом отправки данных, если специальное поле отсутствует. Перед отправкой своих персональных данных Субъект ПД должен ознакомиться с содержанием Политики. Оператор ПД размещает в веб-формах на своем сайте ссылку на текст Политики, для того чтобы Субъект ПД имел возможность ознакомиться с содержанием Политики перед отправкой своих персональных данных. - Субъект ПД дает согласие на обработку Оператором ПД своих персональных данных, не являющихся специальными или биометрическими, в том числе номера контактных телефонов, адрес проживания, адреса электронной почты, место работы и занимаемая должность, сведения о местоположении, тип и версия операционной системы, тип и версия браузера, тип устройства и разрешение его экрана, источник перехода на сайт, включая адрес сайта-источника и текст размещенного на нем рекламного объявления, язык операционной системы и браузера, список посещенных страниц и выполненных на них действий, IP-адрес. - Оператор ПД не обрабатывает персональные данные специальной категории, в том числе данные о политических, религиозных и иных убеждениях, о членстве в общественных объединениях и профсоюзной деятельности, о частной и интимной жизни Субъекта ПД.  <br>
               1.4. Согласие на обработку персональных данных действует бессрочно с момента предоставления данных Субъектом ПД Оператору ПД и может быть отозвано путем подачи заявления Оператору ПД с указанием сведений, определенных ст. 14 Федерального закона «О персональных данных». Отзыв согласия на обработку персональных данных может быть осуществлен путем направления Субъектом ПД соответствующего заявления Оператору ПД в свободной письменной форме по адресу [почтовый или электронный адрес].  <br>
               2. Передача персональных данных <br>
               2.1 Оператор ПД предоставляет доступ к персональным данным только Субъекту ПД либо его законному представителю в соответствии с требованием законодательства РФ.   <br>
               2.2 Оператор ПД не передает персональные данные, полученные от Субъекта ПД, третьим лицам, кроме случаев, предусмотренных действующим законодательством РФ.  <br>
               3. Права Субъекта ПД  <br>
               3.1. Субъект ПД или его законный представитель вправе требовать уточнения персональных данных в случае, если они изменились или если при их предоставлении были допущены неточности. <br>
               3.2. Субъект ПД или его законный представитель вправе требовать блокировки или уничтожения предоставленных персональных данных в случае отказа от дальнейшего обслуживания Оператором ПД и посещения его интернет-сайта.
            </p>
         </div>
       </div>
     </div>
   </div>
   
   <div class="modal fade thank-you tac" id="thank-you" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
         <div class="modal-body">
            <h5 class="priv">Спасибо</h5>
            <p>
               Ваша заявка отправлена !
            </p>
         </div>
       </div>
     </div>
   </div>

   <!-- END MODALS -->

   <header>
      <div class="container">         
         <div class="logo">
            <a href="/"><img src="/web/images/logo.png" alt=""></a>
            <button><span></span><span></span><span></span></button>
         </div>
        <div class="m-view">
           <div class="cent-header">
              <ul>
                 <li><a href="<?= Yii::$app->urlManager->createUrl(['site/payment']) ?>"><i class="icon payment"></i><span>Оплата</span></a></li>
                 <li><a href="<?= Yii::$app->urlManager->createUrl(['site/payment#delivery']) ?>"><i class="icon delivery"></i><span>Доставка</span></a></li>
                 <li><a href="<?= Yii::$app->urlManager->createUrl(['site/payment#guarantees']) ?>"><i class="icon guarantees"></i><span>Гарантии</span></a></li>
                 <li><a href="/#about"><i class="icon about"></i><span>О нас</span></a></li>
                 <li><a href="<?= Yii::$app->urlManager->createUrl(['site/contacts']) ?>"><i class="icon contacts"></i><span>Контакты</span></a></li>
                 <li><a href="<?= Yii::$app->urlManager->createUrl(['site/promos']) ?>"><i class="icon promotions"></i><span>Акции</span></a></li>
              </ul>
              <div class="in-header clear">
                 <!--<a href="#" class="b"><i class="icon pin"></i><span><?php //if($users->city) echo $users->city; else echo "Москва" ?></span></a>-->
                 <a href="<?= $options->insta ?>" target="blanc" class="link-net-top">Instagram</a>
                 <a href="mailto:<?= $options->siteemail ?>"><i class="icon mail"></i><span><?= $options->siteemail ?></span></a>
              </div>
           </div>
           <div class="end-cont">
              <a href="tel:<?= $options->phone ?>" class="top-call"><?= $options->phone ?></a> <br>
              <a href="#" class="callback-window"><span>Мы можем Вам перезвонить</span></a>
              <a href="https://wa.me/<?= $options->phone ?>" class="wp-whatsapp"><i class="icon whatsapp"></i>или кликните</a>
           </div>
        </div>
      </div>
   </header>
   <nav class="top-nav">
      <div class="container clear">
        <?php if($activePage == 'index') require_once "top-menu.php";
              else {
         ?>
         <?php 
          echo Breadcrumbs::widget([
              'itemTemplate' => "<li>{link}</li>\n",
              'homeLink' => [
                  'label' => 'Главная ',
                  'url' => Yii::$app->homeUrl,
                  'title' => 'Первая страница сайта',
              ],
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              'options' => ['class' => 'nav-ul way', 'style' => ''],
          ]);
         ?>

        <?php } ?>
         <div class="f-r">

<!--  Виджет формы поиска  -->
          <?=\app\widgets\search\SearchWidget::widget()?>

           <div class="top-cart">
              <i class="icon cart"></i>
              <a href="<?= Yii::$app->urlManager->createUrl(['site/cart']) ?>">
                <ul>
                   <li>
                      Товаров  <span class="product-cart"><?= $cart ?></span>
                   </li>
                   <li>
                      Сумма <span class="price-cart"><?= $cartPrice ?></span> руб.
                   </li>
                </ul> 
              </a>
           </div>
         </div>
      </div>
   </nav>

<?= $content ?>

   <footer>
      <div class="container">
         <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 offset-md-3 offset-xl-0 offset-lg-0 wp-logo-f">
               <div class="logo-f">
                  <a href="/"><img src="/web/images/logo.png" alt=""></a><br>
                  <span><?= date('Y') ?> &copy; Все права защищены</span>
               </div>
               <div class="time-f">
                  <i class="icon clock"></i><span>09-00 - 21-00</span>
               </div>
            </div>
            <div class="col-xl-3 col-lg-4 menu-f border-lg">
               <ul>
                  <li><a href="<?= Yii::$app->urlManager->createUrl(['site/payment']) ?>"><span>Оплата</span></a></li>
                  <li><a href="<?= Yii::$app->urlManager->createUrl(['site/payment#delivery']) ?>"><span>Доставка</span></a></li>
                  <li><a href="<?= Yii::$app->urlManager->createUrl(['site/payment#guarantees']) ?>"><span>Гарантии</span></a></li>
                  <li><a href="/#about"><span>О нас</span></a></li>
                  <li><a href="<?= Yii::$app->urlManager->createUrl(['site/contacts']) ?>"><span>Контакты</span></a></li>
                  <li><a href="<?= Yii::$app->urlManager->createUrl(['site/promos']) ?>"><span>Акции</span></a></li>
               </ul>
            </div>
            <?php $cats = $functions->getLevelCat(4) ?>
            <div class="col-xl-3 col-lg-4 menu-f border-lg">
               <ul>
                  <li><a href="/">Главная</a></li>
                  <?php foreach($cats as $cat) { ?>
                  <li><a href="<?= Yii::$app->urlManager->createUrl(['site/category', 'id' => $cat->id]) ?>"><?= $cat->name ?></a></li> 
                  <?php } ?>
                  <!--<li><a href="#">Каталог</a></li>-->
               </ul>
            </div>
            <div class="col-xl-2 col-lg-12 border-lg end-f">
               <div class="end-cont">
                  <a href="tel:<?= $options->phone ?>" class="top-call"><?= $options->phone ?></a> <br>
                  <a href="#" class="callback-window"><span>Мы можем Вам перезвонить</span></a>
                  <a href="https://wa.me/<?= $options->phone ?>" class="wp-whatsapp"><i class="icon whatsapp"></i>или кликните</a>
                  <a href="mailto:<?= $options->siteemail ?>" class="wp-whatsapp"><i class="icon mail"></i><?= $options->siteemail ?></a>
                  <a href="<?= $options->insta ?>" target="blanc" class="tac">Instagram</a>
               </div>
            </div>
         </div>
      </div>
   </footer>
<!-- js -->
<script src="/web/js/jquery.js" type="text/javascript"></script>
<script src="/web/js/bootstrap.js" type="text/javascript"></script>
<script src="/web/js/slick.min.js" type="text/javascript"></script>
<script src="/web/js/jquery.fancybox.min.js"></script>
<script src="/web/js/inputmask.js"></script>
<script src="/web/js/jquery.inputmask.js"></script>
<script src="/web/js/jquery-ui.min.js" type="text/javascript"></script>
<script src="/web/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="/web/js/form2js.js" type="text/javascript"></script>
<script src="/web/js/json2.js" type="text/javascript"></script>

<script src="/web/js/functions.js"></script>
<script src="/web/js/cart.js"></script>
<script src="/web/js/sdek.js"></script>
<script src="/web/js/common.js"></script>
<script>
   //var value = Math.ceil(Number(ui.item.id) / 100) * 100;
   /*var num = '210';
   var value = Math.ceil(Number(num) / 100) * 100;
  alert(value);*/
</script>
<script>
  //alert($("#amount").val())
</script>
</body>
</html>
<?php $this->endPage() ?>
