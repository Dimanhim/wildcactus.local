<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    $this->title = $page->title;
    $this->registerMetaTag(['name' => 'description ', 'content' => $page->metadesc]);
    $this->params['breadcrumbs'][] = array(
        'label'=> $page->route, 
        'url'=>Url::toRoute('/'.'search'.".html")
    );
?>
   <div class="block-info stock-in container">
      <h3>
         <span>Результаты поиска </span>
      </h3>
  <?php if($search) { ?>
    <ul>
    <?php foreach($search as $s) { ?>
        <li class="item-search">
          <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $s->id]) ?>">
            <?= $s->name ?>
          </a>
        </li>
    <?php } ?>
    </ul>
  <?php } else { ?>
    <p class="no-result">
      Рузельтатов не найдено
    </p>
  <?php } ?>
   </div>

