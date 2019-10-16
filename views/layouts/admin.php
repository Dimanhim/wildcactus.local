<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;
use yii\widgets\LinkPager;
use app\components\Functions;

$function = new Functions();

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin-панель</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="Admin-панель." />
	<meta name="keywords" content="admin панель, управление сайтом, управление лендингом" />
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
	<!--<link type="text/css" rel="stylesheet" href="css/libs.min.css" />
	<link type="text/css" rel="stylesheet" href="css/admin.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/libs.min.js"></script>-->
</head>
<body>
<?php $this->beginBody() ?>
	<div class="top">
		<div class="container-fluid">
			<div class="row top-bg">
				<div class="col-md-6">
					<!--<p class="company">StavTime</p>-->
					<p><img src="/web/images/admin/logo.png" class="logo" alt=""></p>
				</div>
				<div class="col-md-3">
					<h3>Панель управления WildCactus</h3>
				</div>
				<div class="col-md-3">
					<div id="logout">
						<p><span>Здравствуйте, <?= $function->getName() ?>! </span></p>
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/exit']) ?>">Выход</a>
					</div>
				</div>
			</div>
			<div class="row">
				<ul>
					<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/help']) ?>">Справка</a></li>
					<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/settings']) ?>">Администратор</a></li>
					<li><a href="http://wildcactus.ru:2222/" target="blanc">Хостинг</a></li>
					<li><a href="/" target="blanc">На сайт</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="content container-fluid">
			<div class="row">
				<div class="col-md-2">
					<div class="menu">
						<h3>Меню</h3>
						<ul>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin']) ?>">Главная</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/orders']) ?>">Заявки</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/stat']) ?>">Статистика</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/categories']) ?>">Категории товаров</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/promos']) ?>">Акции</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/banners']) ?>">Баннеры</a></li>
						</ul>
					</div>
					<div class="menu">
						<h3>Товары:</h3>
						<ul>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/products']) ?>">Список</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/product-reserve']) ?>">Резерв</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/addproduct']) ?>">Добавить</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/searchproduct']) ?>">Найти</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/stock']) ?>">Склад</a></li>
						</ul>
					</div>
					<div class="new_order">
						<a href="<?= Yii::$app->urlManager->createUrl(['admin/addorder']) ?>">Добавить заявку</a>
					</div>
					<div class="menu">
						<h3>Страницы</h3>
						<ul>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/page-main']) ?>">Главная</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/page-oplata']) ?>">Оплата-Доставка-Гарантии</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/page-promos']) ?>">Акции</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/page-search']) ?>">Поиск</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/page-product']) ?>">Товары</a></li>
						</ul>
					</div>
					<div class="menu">
						<h3>Статистика</h3>
						<ul>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/split']) ?>">Сплит-шаблон</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/form']) ?>">Заполненная форма</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/source']) ?>">Переход с сайта</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/campaign']) ?>">ID рекламной кампании/Город</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/content']) ?>">ID объявления/тип/позиция</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/term']) ?>">Ключевая фраза</a></li>
						</ul>
					</div>
					<div class="menu">
						<h3>Заявки</h3>
						<ul>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/orders', 'status' => 3]) ?>">В работе</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/orders', 'status' => 1]) ?>">В архиве</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/orders', 'status' => 2]) ?>">Выполненные</a></li>
							<li><a href="<?= Yii::$app->urlManager->createUrl(['admin/orders', 'quan' => 'all']) ?>">Все</a></li>
						</ul>
					</div>
				</div>

				<?= $content ?>
			</div>
	</div>
<?php $this->endBody() ?>

<?php require_once "confirm.php" ?>	
<?php require_once "ajax.php" ?>	
</body>
</html>
<?php $this->endPage() ?>
