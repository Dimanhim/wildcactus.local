<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <h2>Уважаемая, <?= $admin ?></h2>
    <h3>Новая заявка с сайта <?= $site ?></h3>
    <p></p>
    <p>Имя отправителя - <?= $name ?></p>
    <p>Номер телефона - <?= $phone ?></p>
    <p>Email отправителя - <?= $email ?></p>
    <p>Сообщение - <?= $list ?></p>
    <p>Нажатая кнопка - <?= $btn ?></p>
    <p></p>
    <p>Данная заявка успешно добавлена в базу данных</p>
    <p>С уважением!</p>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
