<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
?>
<?php $form = ActiveForm::begin(['action' => '/'], ['fieldConfig' => ['options' => ['tag' => false]]]) ?>
<input id="city" class="input-search-top" placeholder="Начните вводить Ваш город" />
<?= $form->field($pageForm, 'city', ['template' => "{input}"])->hiddenInput(['id' => 'cityname', 'value' => '']) ?>
<?= $form->field($pageForm, 'cityid', ['template' => "{input}"])->hiddenInput(['id' => 'cityid', 'value' => '']) ?>
<?= Html::submitButton('Выбрать', ['class' => 'main-bt green']); ?>
<?php ActiveForm::end() ?>

<!--<input id="city" class="input-search-top" placeholder="Начните вводить Ваш город" />
<input type="hidden" name="receiverCityId" id="receiverCityId" />-->