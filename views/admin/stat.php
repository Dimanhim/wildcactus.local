<?php 

namespace app\models;

use Yii;

use app\components\Functions;

$function = new Functions();
if(!$function->isAdmin()) $function->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));
?>
<div class="col-md-10">
	<div class="menu">
		<h3>Статистика</h3>
		<div class="container-fluid">
			<div class="row stat_buttons">
					<div class="col-md-4">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/split']) ?>">Сплит-шаблон</a>
					</div>
					<div class="col-md-4">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/form']) ?>">Заполненная форма</a>
					</div>
					<div class="col-md-4">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/source']) ?>">Переход с сайта</a>
					</div>
					<div class="col-md-4">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/campaign']) ?>">ID рекламной кампании/Город</a>
					</div>
					<div class="col-md-4">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/content']) ?>">ID объявления/тип/позиция</a>
					</div>
					<div class="col-md-4">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/term']) ?>">Ключевая фраза</a>
					</div>
			</div>
		</div>
	</div>
</div>