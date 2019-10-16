<?php 

namespace app\components;

use Yii;

use yii\db\ActiveRecord;
use app\models\Lan_orders;
use app\models\Users;
use app\models\Options;
use app\models\Categories;
use app\models\Products;
use app\models\Promos;
use app\models\Stock;
use app\models\Cart;
use app\models\Sef;
use app\models\Productcats;
use yii\widgets\LinkPager;

class Functions
{
	public function getStatus($status)
	{
		if($status == 3)
		{
			return 'В работе';
		}
		else if($status == 1)
		{
			return 'Архивная';
		}
		else if($status == 4)
		{
			return 'Оплачен';
		}
		else if($status == 5)
		{
			return 'Зарезервирован';
		}
		else if($status == 2)
		{
			return 'Выполнена';
		}
		else
		{
			return '';
		}

	}

	public function getDate($date)
	{
		return date("d.m.Y H:i", $date);
	}
	public function getFullDate($date)
	{
		return date("d.m.Y H:i", $date);
	}

	public function getPercentSplit($orders, $split)
	{
		$countSplit = 0;
		$countSplits = 0;
		foreach($orders as $order) {
			if($order->split == $split) $countSplit++;
			$countSplits++;
		}
		return round((($countSplit / $countSplits) * 100), 2);
	}
	public function getPercentForm($orders, $btn)
	{
		$countSplit = 0;
		$countSplits = 0;
		foreach($orders as $order) {
			if($order->btn == $btn) $countSplit++;
			$countSplits++;
		}
		return round((($countSplit / $countSplits) * 100), 2);
	}
	public function getPercentSource($orders, $btn)
	{
		$countSplit = 0;
		$countSplits = 0;
		foreach($orders as $order) {
			if($order->utm_source == $btn) $countSplit++;
			$countSplits++;
		}
		return round((($countSplit / $countSplits) * 100), 2);
	}
	public function getPercentCampaign($orders, $btn)
	{
		$countSplit = 0;
		$countSplits = 0;
		foreach($orders as $order) {
			if($order->utm_campaign == $btn) $countSplit++;
			$countSplits++;
		}
		return round((($countSplit / $countSplits) * 100), 2);
	}
	public function getPercentContent($orders, $btn)
	{
		$countSplit = 0;
		$countSplits = 0;
		foreach($orders as $order) {
			if($order->utm_content == $btn) $countSplit++;
			$countSplits++;
		}
		return round((($countSplit / $countSplits) * 100), 2);
	}
	public function getPercentTerm($orders, $btn)
	{
		$countSplit = 0;
		$countSplits = 0;
		foreach($orders as $order) {
			if($order->utm_term == $btn) $countSplit++;
			$countSplits++;
		}
		return round((($countSplit / $countSplits) * 100), 2);
	}
	public function countSplitOrders($orders, $split)
	{
		$countSplit = 0;
		foreach($orders as $order) {
			if($order->split == $split) $countSplit++;
		}
		return $countSplit;
	}
	public function countFormOrders($orders, $btn)
	{
		$countSplit = 0;
		foreach($orders as $order) {
			if($order->btn == $btn) $countSplit++;
		}
		return $countSplit;
	}
	public function countSourceOrders($orders, $btn)
	{
		$countSplit = 0;
		foreach($orders as $order) {
			if($order->utm_source == $btn) $countSplit++;
		}
		return $countSplit;
	}
	public function countCampaignOrders($orders, $btn)
	{
		$countSplit = 0;
		foreach($orders as $order) {
			if($order->utm_campaign == $btn) $countSplit++;
		}
		return $countSplit;
	}
	public function countContentOrders($orders, $btn)
	{
		$countSplit = 0;
		foreach($orders as $order) {
			if($order->utm_content == $btn) $countSplit++;
		}
		return $countSplit;
	}
	public function countTermOrders($orders, $btn)
	{
		$countSplit = 0;
		foreach($orders as $order) {
			if($order->utm_term == $btn) $countSplit++;
		}
		return $countSplit;
	}

	public function getName()
	{
		$option = Options::find();
		$name = $option->select(['name'])->one();
		return $name->name;
	}

	public function isAdmin() {
		$session = Yii::$app->session;
		if($session->has('loginLand')) {
			$login_sess = $session->get('loginLand');
		}
		if($session->has('passwordLand')) {
			$password_sess = $session->get('passwordLand');
		}
		$login_bd = Options::find()->select(['login'])->one()->login;
		$password_bd = Options::find()->select(['password'])->one()->password;
		if($login_sess == $login_bd) {
			if($password_sess == $password_bd) return true;
			else return false;
		}
		else return false;
		
	}

	public function isUserLog() {
		$session = Yii::$app->session;
		$login = Yii::$app->request->get('userLogin');
		if($login != '') $session->set('userLogin', $login);
		$userLogin = $session->get('userLogin');
		$user = Users::find()->where(['username' => $userLogin])->one()->username;
		if(($user == $userLogin) && ($user != '')) return true;
		else return false;
	}

	public function redirectLogin($link) {
		header("Location: $link");
		exit;
	}

	// Смена даты формой
	public function changeDate($time) {
		$option = Options::find();
		$period = $option->select(['period'])->one()->period;
		$session = Yii::$app->session;
		if(count($time) < 1) {
            $time[0] = time();
        }
        $minDate = min($time);
        $maxDate = max($time);

        if($session->has('fromOrdersDate')) {
	        $fromDate = $session->get('fromOrdersDate');
	        $toDate = $this->roundToDate($session->get('toOrdersDate'));
	        $message = "показано по датам";
	    }
	    else {
	        $session->set('fromOrdersDate', time() - $period*86400);
            $session->set('toOrdersDate', time());
            $fromDate = $session->get('fromOrdersDate');
	        $toDate = $session->get('toOrdersDate');
	        $message = "Все за ".$period." дней";
	    }

        // Получение значений дат из формы и запись их в сессию
        if(Yii::$app->request->post('change_date') == 'true') {
            $from_day = Yii::$app->request->post('from_day');
            $from_month = Yii::$app->request->post('from_month');
            $from_year = Yii::$app->request->post('from_year');
            $to_day = Yii::$app->request->post('to_day');
            $to_month = Yii::$app->request->post('to_month');
            $to_year = Yii::$app->request->post('to_year');

            $fromTime = mktime(0, 0, 0, $from_month, $from_day, $from_year);
            $toTime = mktime(23, 59, 59, $to_month, $to_day, $to_year);
            $session->set('fromOrdersDate', $fromTime);
            $session->set('toOrdersDate', $toTime);
			$fromDate = $fromTime;
     		$toDate = $toTime;
            $message = "показано по датам";
        }

        // Получение минимальных максимальных лет
        $minYear = date('Y', $minDate);
        $maxYear = date('Y', $maxDate);

        // Получение минимальных и максимальных дат выборки
        $fromDay = date('d', $fromDate);
        $fromMonth = date('m', $fromDate);
        $fromYear = date('Y', $fromDate);
        $toDay = date('d', $toDate);
        $toMonth = date('m', $toDate);
        $toYear = date('Y', $toDate);

        // Возвращаем массив с датами, количеством из выборки и сообщением
        $date = array(
            'minYear' => $minYear,
            'maxYear' => $maxYear,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'fromDay' => $fromDay,
            'fromMonth' => $fromMonth,
            'fromYear' => $fromYear,
            'toDay' => $toDay,
            'toMonth' => $toMonth,
            'toYear' => $toYear,
            'countItems' => $countItems,
            'message' => $message,
        );
        return $date;
// Конец выборки
	}

	public function roundToDate($time) {
		$day = date('d', $time);
		$month = date('m', $time);
		$year = date('Y', $time);
		return mktime(23, 59, 59, $month, $day, $year);
	}
	public function getStatusByNumber($status)
	{
		if(($status == 0) || ($status == null)) return "Не опубликовано";
		elseif($status == 1) return "Опубликовано";
		else return "Неизвестный статус";
	}
	public function getParentCategoryName($parent)
	{
		$category = Categories::find()->where(['id' => $parent])->one();
		return $category->name;
	}
	public function getChildrenCategories($id)
	{
		$categories = Categories::find()->all();
		$message = "<ul class='undercategories'>";
		foreach($categories as $category) {
			if($category->parent == $id) {
				$message .= "<li><a href='".Yii::$app->urlManager->createUrl(['admin/category', 'id' => $category->id])."'>".$category->name."</a></li>";
			}
		}
		$message .= "</ul>";
		return $message;
	}
	public function isNewProduct($new)
	{
		if(($new == null) || ($new == 0)) return "Не новый";
		elseif($new == 1) return "Новый";
		else return "Неизвестно";
	}
	public function isHitProduct($hit)
	{
		if(($hit == null) || ($hit == 0)) return "Не хит";
		elseif($hit == 1) return "Хит";
		else return "Неизвестно";
	}
	public function whatPromoProduct($promo)
	{
		return "Акция";
	}
	public function isProductPromo($promo)
	{
		if(($promo == 0) || ($promo == null)) return 'Нет';
		else {
			$promos = Promos::find()->where(['id' => $promo])->one();
			if($promos) return $promos->name;
			else return 'Такой акции не существует';
		}

	}
	public function getStatusStock($status)
	{
		if(($status == null) || ($status == 0)) return "На складе";
		elseif($status == 1) return "Зарезервирован";
		elseif($status == 2) return "Ожидает отправки";
		else return "Неизвестно";
	}
	public function getStockProducts($product, $status)
	{
		return Stock::find()->where(['product' => $product])->andWhere(['status' => $status])->count();
	}
	public function getProduct($id)
	{
		return Products::find()->where(['id' => $id])->one();
	}

	// Открываем корзину
	public function getCart()
	{
		$session = Yii::$app->session;
		$userIp = $session->get('userIp');
        if(Cart::find()->where(['user' => $userIp])->exists()) $cart = Cart::find()->where(['user' => $userIp]);
        else $cart = new Cart();
        return $cart;
	}
	public function getProductPrice($id)
	{
		return Products::find()->where(['id' => $id])->one()->price;
	}
	public function getSummaCart($user)
	{
		$carts= Cart::find()->where(['user' => $user])->all();
		$summa = 0;
		foreach($carts as $item) {
            $summa = $summa + ($this->getProductPrice($item->product)) * $item->quan;
        }
        return $summa;
	}
	public function isProductInCart($id)
	{
		$session = Yii::$app->session;
		$userIp = $session->get('userIp');
		if(Cart::find()->where(['user' => $userIp])->andWhere(['product' => $id])->exists()) return true;
		else return false;
	}
	public function isProductOnStock($id)
	{
		$products = Products::findOne($id);
		if($products->stock < 1) return false;
		else return true;
	}
	public function getLevelCat($quan)
	{
		$categories = Categories::find()->where(['status' => 1])->andWhere(['level' => 1])->orderby('orderby')->limit($quan)->all();
		return $categories;
	}
	public function getAllCats()
	{
		$categories = Categories::find()->where(['status' => 1])->andWhere(['level' => 1])->orderby('orderby')->all();
		return $categories;
	}
	public function getSubCats($parent)
	{
		$categories = Categories::find()->where(['status' => 1, 'parent' => $parent])->orderby('orderby')->all();
		return $categories;
	}
	public function getSubCatsId($categories)
	{
		foreach($categories as $category) {
            $arr[] = $category->id;
        }
        return $arr;
	}
	// Для работы с категориями
     /*public function getCategory($id)
    {
        return Categories::find()->where(['id' => $id])->one();
    }*/
    public function getCatParentCategory($id)
    {
        $category =  Categories::find()->where(['id' => $id])->one();
        return $this->getCategory($category->parent);
    }

	// Для работы с продуктом
	public function getProductCat($id)
	{
        $productcats = Productcats::find()->where(['product' => $id])->one();
		return Categories::find()->where(['id' => $productcats->category])->one();
	}
    public function getCategory($id)
    {
        return Categories::find()->where(['id' => $id])->one();
    }
	public function getParentCategory($id)
	{
	    $productcats = Productcats::find()->where(['product' => $id])->one();
		$category =  Categories::find()->where(['id' => $productcats->category])->one();
		return $this->getCategory($category->parent);
	}


	public function getShortAlias($name)
	{
		return mb_substr(trim($name), 0, 50)."...";
	}
	public function isSefExists($linksef, $link)
	{
		$sef = Sef::find()->where(['linksef' => $linksef]);
		if($sef->exists() && ($sef->one()->link != $link)) return true;
		else return false;
	}
	public function getProductFromCart($id)
	{
		return Products::findOne($id);
	}
	public function deleteOldUsers()
    {
        $time = time();
        $users = Users::find()->all();
        foreach($users as $user) {
            if($time > ($user->date + 1209600)) {
                $user->delete();
                $carts = Cart::find()->where(['user' => $user->user])->all();
                foreach($carts as $cart) {
                    $cart->delete();
                }
            }
        }
    }
    public function getProductsName($string)
    {
    	$products = explode(',', $string);
    	
    	$print_product = "";

    	foreach($products as $product) {
    		if($product) {
    			$print_product .= "<li><a href='".Yii::$app->urlManager->createUrl(['admin/product', 'id' => $product])."'>".$this->getProductName($product)."</a></li>";
    		}
    	}
    	return trim($print_product);
    }
    public function getProductsNames($string)
    {
    	$products = explode(',', $string);
    	$product_names = [];
    	foreach($products as $product)
    	{
    		$product_names[$product] = $this->getProductName($product);
    	}

    	return $product_names;
    }
    /*public function getProductsQuan($string)
    {

    }*/
    public function getProductName($id)
    {
    	return Products::find()->where(['id' => $id])->one()->name;
    }
    public function quanProductInCart($id)
    {
    	$session = Yii::$app->session;
		$userIp = $session->get('userIp');
    	$carts = Cart::find()->where(['product' => $id])->andWhere(['user' => $userIp]);
    	if($carts->exists()) return $carts->one()->quan;
    	else return 1;

    }
}
?>