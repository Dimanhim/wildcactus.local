<?php
use app\components\Functions;
use yii\helpers\Url;
$functions = new Functions();
$this->title = $page->title;
$this->registerMetaTag(['name' => 'description ', 'content' => $page->metadesc]);
$this->params['breadcrumbs'][] = array(
   'label'=> $page->route, 
   'url'=>Url::toRoute("/oplata.html")
);
?>
   <div class="block-info container">
      <h3>
         <span>Оплата</span> <i class="icon payment"></i>
      </h3> 
      <div class="in-block-info payment-info">
         <ul>
            <li><i class="icon payment2"></i><?= $payment->header ?></li>
         </ul>
         <p>
            <?= $payment->text ?>
         </p>
      </div>
   </div>
   <div class="block-info wp-delivery-block" id="delivery">
      <div class="container">
         <h3>
            <span>Доставка</span> <i class="icon delivery"></i>
         </h3>
         <div class="in-block-info delivery-info">
            <ul>
               <li><i class="icon pickup"></i><?= $delivery->headerfirst ?></li>
               <li><i class="icon post"></i><?= $delivery->headersecond ?></li>
            </ul>
            <p>
               <?= $delivery->text ?>
            </p>
            <h6><span>•</span><?= $delivery->headerfirst ?></h6>
            <p>
               <?= $delivery->textfirst ?>
            </p>
            <h6><span>•</span><?= $delivery->headersecond ?></h6> 
            <p>
               <?= $delivery->textsecond ?>
            </p>
         </div>
      </div>
   </div>
   <div class="block-info container" id="guarantees">
      <h3>
         <span>Гарантии</span> <i class="icon guarantees"></i>
      </h3>
      <div class="in-block-info guarantees-info">
         <ul>
            <li><i class="icon purchase"></i><?= $garantees->headerone ?></li>
            <li><i class="icon back"></i><?= $garantees->headertwo ?></li>
            <li><i class="icon exchange"></i><?= $garantees->headerthree ?></li>
         </ul>
         <p>
            <?= $garantees->description ?>
         </p>
         <p>
            <?php if($garantees->textone) { ?><span>•</span> <?= $garantees->textone ?> <br><?php } ?>
            <?php if($garantees->texttwo) { ?><span>•</span> <?= $garantees->texttwo ?> <br><?php } ?>
            <?php if($garantees->textthree) { ?><span>•</span> <?= $garantees->textthree ?> <br><?php } ?>
            <?php if($garantees->textfour) { ?><span>•</span> <?= $garantees->textfour ?> <br><?php } ?>
            <?php if($garantees->textfive) { ?><span>•</span> <?= $garantees->textfive ?> <br><?php } ?>
            <?php if($garantees->textsix) { ?><span>•</span> <?= $garantees->textsix ?> <br><?php } ?>
            <?php if($garantees->textseven) { ?><span>•</span> <?= $garantees->textseven ?> <br><?php } ?>
            <?php if($garantees->texteight) { ?><span>•</span> <?= $garantees->texteight ?> <br><?php } ?>
         </p>
      </div>
   </div>
