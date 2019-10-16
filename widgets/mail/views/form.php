<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
?>
	<div class="modal fade select-c" id="form-c" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
         <div class="modal-body">
            <h5>
               Оcтавьте свой номер телефона, <br>
               мы Вам обязательно перезвоним
            </h5>
            <?php $form = ActiveForm::begin(['action' => '/'], ['fieldConfig' => ['options' => ['tag' => false]]]) ?>
            <div class="form">
            	<?= $form->field($pageForm, 'name', ['template' => "{input}"])->textInput(['placeholder' => 'Ваше имя', "class" => ""]) ?>
            	<?= $form->field($pageForm, 'phone', ['template' => "{input}"])->textInput(['class' => 'phone', 'placeholder' => 'Телефон']) ?>
            	<?= $form->field($pageForm, 'plan', ['template' => "{input}"])->textInput(['placeholder' => 'Удобное время для звонка', "class" => ""]) ?>
               <div class="wp-prav">
                  <div class="wp-radio">
                     <input type="checkbox" name="delivery" id="n50">
                     <label for="n50"></label>
                  </div>
                  <label for="n50" class="p">Я согласен с <span>политикой обработки персональных данных</span></label>
               </div>
               <div class="tac">
               		<?= Html::submitButton("<b>Заказать звонок</b>", ['class' => 'main-bt green']); ?>
               </div>
            </div>
           <?php ActiveForm::end() ?>
         </div>
       </div>
     </div>
   </div>
