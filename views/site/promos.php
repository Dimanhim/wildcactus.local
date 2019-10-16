<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    $this->title = $page->title;
    $this->registerMetaTag(['name' => 'description ', 'content' => $page->metadesc]);
    $this->params['breadcrumbs'][] = array(
        'label'=> $page->route, 
        'url'=>Url::toRoute('/'.'promos'.".html")
    );
?>
   <div class="block-info stock-in container">
      <h3>
         <span>АКЦИИ </span> <i class="icon cart"></i>
      </h3>
      <div class="owl-carousel promo owl-theme owl-loaded owl-drag">
      <?php foreach($promos as $promo) { ?>
        <div>
            <img src="<?= PATH.$promo->img ?>" alt="">
            <div class="info-page">
              <p>
                 <?= $promo->text1 ?> 
              </p>
              <p>
                 <?= $promo->text2 ?> 
              </p>
           </div>
        </div>
      <?php } ?>
      </div>
      
   </div>

