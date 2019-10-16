<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    $this->title = $page->title;
    $this->params['breadcrumbs'][] = array(
        'label'=> $page->route, 
        'url'=>Url::toRoute('/'.'contacts'.".html")
    );
?>
   <div class="block-info wp-contacts container">
      <h3>
         <span>НАШИ КОнтакты </span> <i class="icon contacts"></i>
      </h3>
      <div class="ps">
         Вы можете связаться с нами любым, удобным для Вас способом. Мы ответим на все Ваши вопросы, учтем Ваши  пожелания или замечания.
      </div>
      <div class="in-block-info">
         <ul>
            <li><i class="icon call"></i><a href="tel:+7(906) 4790497" class="no-link">+7(906) 4790497</a></li>
            <li><i class="icon mail"></i><a href="mailto:icase26@mail.ru" class="no-link">icase26@mail.ru</a></li>
            <li><i class="icon whatsapp"></i><a href="https://wa.me/79064790497" class="no-link">WhatsApp</a></li>
            <li><i class="icon instagram"></i><a href="https://www.instagram.com/_wildcactus_/?utm_source=from_website" class="no-link">Instagram</a></li>
         </ul>
         <div class="row">
            <div class="col-md-7">
               <p>
                   Или заполните заявку и мы свяжемся с Вами
               </p>
               <?php $form = ActiveForm::begin(['fieldConfig' => ['options' => ['tag' => false]], 'options' => ['class' => 'form send-data']]) ?>
                  <div class="row">
                     <div class="col-md-4">
                        <?= $form->field($pageForm, 'name', ['template' => "{input}"])->textInput(['placeholder' => "Имя", 'class' => '']) ?>
                     </div>
                     <div class="col-md-4">
                        <?= $form->field($pageForm, 'phone', ['template' => "{input}"])->textInput(['placeholder' => "Телефон", 'class' => 'phone']) ?>
                     </div>
                     <div class="col-md-4">
                        <?= $form->field($pageForm, 'email', ['template' => "{input}"])->textInput(['placeholder' => "E-mail", 'type' => 'email', 'class' => '']) ?>
                     </div>
                     <div class="col-md-12">
                      <?= $form->field($pageForm, 'plan', ['template' => "{input}"])->textarea(['placeholder' => 'Ваш вопрос', 'class' => '']) ?>
                      <?= $form->field($pageForm, 'btn', ['template' => "{input}"])->hiddenInput(['value' => "Форма на странице контактов"]) ?>
                      <?= Html::submitButton('Отправить', ['class' => "main-bt green"]) ?>
                     </div>
                  </div>
               <?php ActiveForm::end() ?>
            </div>
         </div>
         <div class="more-contacts">
            ИП Ферсенко Юлия Юрьевна <br>
            ИНН 262309847865 <br>
            ОГРНИП 319265100015832
         </div>
      </div>
   </div>
