<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
?>
	 <?php $form = ActiveForm::begin(['action' => Yii::$app->urlManager->createUrl(['site/search']),'fieldConfig' => ['options' => ['tag' => false]]], ['fieldConfig' => ['options' => ['tag' => false]]]) ?>
      <?= Html::submitButton(" ", ['class' => 'search-btn']); ?>
      <?= $form->field($pageForm, 'search', ['template' => "{input}"])->textInput(["class" => "input-search-top"]) ?>
   <?php ActiveForm::end() ?>
