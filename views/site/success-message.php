<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = $page->title;
$this->registerMetaTag(['name' => 'description ', 'content' => 'Заявка успешно отправлена!']);
$this->params['breadcrumbs'][] = array(
    'label'=> 'Успешная отправка заявки',
    'url'=>Url::toRoute('/'.'success-message'.".html")
);
?>
<div class="block-info stock-in container">
    <h3>
        Ваша заявка успешно отправлена!
    </h3>
    <p class="no-result">Наши специалисты свяжутся с Вами в ближайшее время!</p>
</div>


