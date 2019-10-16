<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    $this->title = $page->title;
    $this->registerMetaTag(['name' => 'description ', 'content' => 'Произошла ошибка заказа!']);
    $this->params['breadcrumbs'][] = array(
        'label'=> 'Произошла ошибка заказа', 
        'url'=>Url::toRoute('/'.'false'.".html")
    );
?>
   <div class="block-info stock-in container">
      <h3>
         При оплате заказа произошла ошибка, попробуйте позднее!
      </h3>
      <p class="no-result">Либо обратитесь к администрации сайта</p>
   </div>

