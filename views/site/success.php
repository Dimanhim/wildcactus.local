<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    $this->title = $page->title;
    $this->registerMetaTag(['name' => 'description ', 'content' => 'Оплата заказа прошла успешно!']);
    $this->params['breadcrumbs'][] = array(
        'label'=> 'Успешная оплата заказа', 
        'url'=>Url::toRoute('/'.'success'.".html")
    );
?>
   <div class="block-info stock-in container">
      <h3>
         Ваш заказ успешно оплачен и принят в работу!
      </h3>
      <p class="no-result">Наши специалисты свяжутся с Вами в ближайшее время!</p>
   </div>

