<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\components\Functions;
use app\components\SefRule;

use app\models\Pagemain;
use app\models\Pagepdg;
use app\models\Pagepromos;
use app\models\Pagesearch;
use app\models\Advmain;
use app\models\Blockadv;
use app\models\Blockdelivery;
use app\models\Blockgarantees;
use app\models\Blockpayment;
use app\models\TinkoffMerchantAPI;

use app\models\FormPage;
use app\models\FormCart;
use app\models\FormPageMail;
use app\models\FormPageSearch;
use app\models\FormTinkoff;
use app\models\Header;
use app\models\Utm;
use app\models\Random;
use app\models\Lan_orders;
use app\models\Orders;
use app\models\Options;
use app\models\Promos;
use app\models\Banners;
use app\models\Products;
use app\models\Productimg;
use app\models\Productcats;
use app\models\Categories;
use app\models\Cart;
use app\models\Sef;
use app\models\Users;
use app\models\Stock;
use linslin\yii2\curl;
//$curl = new curl\Curl();

class SiteController extends Controller
{

    public $layout = 'main';
    

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function beforeAction($action)
    {
     if (in_array($action->id, ['checkout'])) {
     $this->enableCsrfValidation = false;
     }
     return parent::beforeAction($action);
    

    /**
     * Displays homepage.
     *
     * @return string
     */
    }

// ГЛАВНАЯ
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $userIp = $session->get('userIp');
    // Открыть корзину
        $functions = new Functions();
        $cart = $functions->getCart();
    //
        $session = Yii::$app->session;
        $userIp = $session->get('userIp');
    // Выбор города
        $form = new FormPage();
        if ($form->load(Yii::$app->request->post())) {
            if(Users::find()->where(['user' => $userIp])->one()) $users = Users::find()->where(['user' => $userIp])->one();
            else $users = new Users();
            $users->user = $userIp;
            $users->city = $form->city;
            $users->cityid = $form->cityid;
            $users->date = time();
            $users->save();
        }
        $form2 = new FormPageMail();
        if ($form2->load(Yii::$app->request->post())) {
            $name = $form2->name;
            $phone = $form2->phone;
            $email = $form2->email;
            $plan = "Удобное время для звонка - ".$form2->plan;
            $btn = $form2->btn;
            $orders = new Lan_orders();
            if($name != null) $orders->name = $name;
            if($phone != null) $orders->phone = $phone;
            if($email != null) $orders->email = $email;
            if($plan != null) $orders->plan = $plan;
            if($btn != null) $orders->btn = $btn;
            $orders->date_order = time();
            $orders->split = $page;
            $orders->status = 4;
            $orders->utm_source = $utm_source;
            $orders->utm_campaign = $utm_campaign;
            $orders->utm_medium = $utm_medium;
            $orders->utm_content = $utm_content;
            $orders->utm_term = $utm_term;
            
            if($orders->save()) {
            $admin = Options::find()->select(['name'])->one()->name;
            $mail = Options::find()->select(['email'])->one()->email;
            $mailname = Options::find()->select(['mailname'])->one()->mailname;
            $site = $mailname;
            $subject = 'Заполнена контактная форма с сайта '.$site;
            if(
            Yii::$app->mailer->compose('user', ['site' => $site, 'admin' => $admin, 'name' => $name, 'phone' => $phone, 'email' => $email, 'list' => $plan, 'btn' => $btn])
                ->setFrom(['info@wildcactus.ru' => $mailname])
                 ->setTo($mail)
                ->setSubject($subject)
                ->setTextBody(' ')
                ->send()
            ) $success = true;
            }
            else $success = false;
        }

        $promos = Promos::find()->where(['status' => 1]);
        $banners = Banners::find()->where(['status' => 1])->all();
        $hits = Products::find()->where(['hit' => 1])->andWhere(['status' => 1])->orderby('orderby');
        $news = Products::find()->where(['new' => 1])->andWhere(['status' => 1])->orderby('orderby');
        $carts = Cart::find()->where(['user' => $userIp])->all();
        $page = Pagemain::find()->one();
        $adv = Advmain::find()->one();

        return $this->render('index', [
            'promos' => $banners,
            'banners' => $promos,
            'hits' => $hits,
            'news' => $news,
            'cart' => $cart,
            'adv' => $adv,
            'pageForm' => $form,
            'page' => $page,
        ]);
    }

// ТОВАР
    public function actionProduct()
    {
        $functions = new Functions();
        if(Yii::$app->request->get('action') == 'change') {
            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $product = Yii::$app->request->get('id');
            $quan = Yii::$app->request->get('count');
            $cartUser = Cart::find()->where(['user' => $userIp, 'product' => $product]);
            if($cartUser->exists()) {
                $find = $cartUser->one();
                $find->quan = $quan;
                $find->save();
            }
            else {
                $cartUser = new Cart();
                $cartUser->user = $userIp;
                $cartUser->product = $product;
                $cartUser->quan = $quan;
                $cartUser->save();
            }
            $summa = $functions->getSummaCart($userIp);
            $count = Cart::find()->where(['user' => $userIp])->count();
            $values = [
                'id' => $product,
                'count' => $count,
                'summa' => $summa,
            ];
            return json_encode($values);
        }
        $session = Yii::$app->session;
        $userIp = $session->get('userIp');
        $id = Yii::$app->request->get('id');
        $product = Products::find()->where(['id' => $id])->one();
        $images = Productimg::find()->where(['product' => $id])->all();
        $hits = Products::find()->where(['hit' => 1])->andWhere(['status' => 1])->orderby('orderby');
        $cart = Cart::find()->where(['user' => $userIp, 'product' => $id])->one();
        return $this->render('product', [
            'product' => $product,
            'images' => $images,
            'hits' => $hits,
            'cart' => $cart,
        ]);
    }
// КОНТАКТЫ
    public function actionContacts()
    {
        $form = new FormPage();
        if ($form->load(Yii::$app->request->post())) {
            $name = $form->name;
            $phone = $form->phone;
            $email = $form->email;
            $plan = $form->plan;
            $btn = $form->btn;
            $orders = new Lan_orders();
            if($name != null) $orders->name = $name;
            if($phone != null) $orders->phone = $phone;
            if($email != null) $orders->email = $email;
            if($plan != null) $orders->plan = $plan;
            if($btn != null) $orders->btn = $btn;
            $orders->date_order = time();
            $orders->split = $page;
            $orders->status = 3;
            $orders->utm_source = $utm_source;
            $orders->utm_campaign = $utm_campaign;
            $orders->utm_medium = $utm_medium;
            $orders->utm_content = $utm_content;
            $orders->utm_term = $utm_term;
            
            if($orders->save()) {
            $admin = Options::find()->select(['name'])->one()->name;
            $mail = Options::find()->select(['email'])->one()->email;
            $mailname = Options::find()->select(['mailname'])->one()->mailname;
            $site = $mailname;
            $subject = 'Заполнена контактная форма с сайта '.$site;
            if(
            Yii::$app->mailer->compose('user', ['site' => $site, 'admin' => $admin, 'name' => $name, 'phone' => $phone, 'email' => $email, 'list' => $plan, 'btn' => $btn])
                ->setFrom(['info@wildcactus.ru' => $mailname])
                 ->setTo($mail)
                ->setSubject($subject)
                ->setTextBody(' ')
                ->send()
            ) $success = true;
            }
            else $success = false;
        }
        return $this->render('contacts', [
            'pageForm' => $form,
            'success' => $success,
        ]);
    }
    public function actionCategory()
    {
        $functions = new Functions();
        $id = Yii::$app->request->get('id');
        $catId = Categories::find()->where(['id' => $id])->one();
                
        if($catId->level == 1) {
            $categories = $functions->getSubCats($catId->id);
            $arr = $functions->getSubCatsId($categories);
        }
        else {
            $categories = Categories::find()->where(['id' => $id])->orderby('orderby')->all();
            $arr = $functions->getSubCatsId($categories);
        }
        $productcats = Productcats::find()->where(['category' => $arr])->all();
        $products_arr = array();
        foreach($productcats as $prods) {
            $products_arr[] = $prods->product;
        }
        $products_arr = array_unique($products_arr);
        $products = Products::find()->orderby('orderby')->where(['id' => $products_arr, 'status' => 1])->all();
        //$products = Products::find()->orderby('orderby')->where(['category' => $arr, 'status' => 1])->all();
        $pageMain = Pagemain::find()->one();

        return $this->render('category', [
            'products' => $products,
            'categories' => $categories,
            'cat' => $catId,
            'arr' => $arr,
            'products_arr' => $products_arr,
            'pageMain' => $pageMain,
        ]);
    }
    public function actionPromos()
    {
        $promos = Promos::find()->all();
        $page = Pagepromos::find()->one();
        return $this->render('promos', [
            'promos' => $promos,
            'page' => $page,
        ]);
    }
    public function actionAddtocart()
    {
    // весь метод - ajax запрос на добавление в корзину
        $this->layout = 'sendcart';
        $functions = new Functions();
        $session = Yii::$app->session;
        $userIp = $session->get('userIp');
        $product = Yii::$app->request->get('id');
        $quan = Yii::$app->request->get('quan');
        //$item = Yii::$app->request->get('item');
        $cartUser = Cart::find()->where(['user' => $userIp])->andWhere(['product' => $product]);
        if($cartUser->exists()) {
            
            $find = $cartUser->one();
            //$quan = $find->quan;
            //$find->quan = $quan + $item;
            $find->quan = $quan;
            $find->save();
        }
        else {
            $cartUser = new Cart();
            $cartUser->user = $userIp;
            $cartUser->product = $product;
            $cartUser->quan = $quan;
            $cartUser->save();
        }
        $cart = Cart::find()->where(['user' => $userIp]);
        $count = Cart::find()->where(['user' => $userIp])->count();
        $carts = $cart->all();
        $summa = $functions->getSummaCart($userIp);
        
        $values = [
            'count' => $count,
            'summa' => $summa,
            'product' => $product,
            'add' => $add,
            'message' => $message,
        ];
        echo json_encode($values);
    }
    public function actionCheckout()
    {
        $functions = new Functions();
        $tinkoff = new FormTinkoff();
    // ---------------ОПЛАТА------------------
        if ($tinkoff->load(Yii::$app->request->post())) {
        //-- рабочий терминал
            $api = new TinkoffMerchantAPI(
                '1558686448245',  //Ваш Terminal_Key
                'uff9q8wx0hr98np7'   //Ваш Secret_Key
            );
            //-- тестовый терминал
            /*$api = new TinkoffMerchantAPI(
                '1558686448245DEMO',  //Ваш Terminal_Key
                'nsga999t7j2w08n6'   //Ваш Secret_Key
            );*/
            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $terminalkey = $tinkoff->TerminalKey;
            $amount = ($tinkoff->Amount)*100;
            $orderId = $tinkoff->OrderId;
            $successUrl = $tinkoff->SuccessURL;
            $failUrl = $tinkoff->FailURL;
            $request = [
                'Amount' => $amount,
                'OrderId' => $orderId,
            ];
            $api->init($request);
            if($api->Success) {
                $session = Yii::$app->session;
                $userIp = $session->get('userIp');
                $orders = new Lan_orders();
                $orders->system = $tinkoff->OrderId;
                $orders->name = $tinkoff->name;
                $orders->email = $tinkoff->email;
                $orders->phone = $tinkoff->phone;
                $orders->username = $userIp;
                $orders->status = 5;
                $orders->price = $tinkoff->Amount;
                $orders->plan = 
                    "Сумма заказа - ".$tinkoff->Amount." рублей. ".
                    "Доставка город (индекс) - ". $tinkoff->description.". ".
                    "Комментарий - ".$tinkoff->Comment
                ;
                //$orders->comment = $tinkoff->description;
                $orders->date_order = time();

//--отправляем письмо админу
            $name = $tinkoff->name;
            $phone = $tinkoff->phone;
            $email = $tinkoff->email;
            $plan = 
            "Сумма заказа - ".$tinkoff->Amount." рублей. ".
                    "Доставка город (индекс) - ". $tinkoff->description.". ".
                    "Комментарий - ".$tinkoff->Comment
            ;
            $btn = "Переход на страницу оплаты";
            
            

            $admin = Options::find()->select(['name'])->one()->name;
            $mail = Options::find()->select(['email'])->one()->email;
            $mailname = Options::find()->select(['mailname'])->one()->mailname;
            $site = $mailname;
            $subject = 'Заполнена контактная форма с сайта '.$site;
            if(
            Yii::$app->mailer->compose('user', ['site' => $site, 'admin' => $admin, 'name' => $name, 'phone' => $phone, 'email' => $email, 'list' => $plan, 'btn' => $btn])
                ->setFrom(['info@wildcactus.ru' => $mailname])
                 ->setTo($mail)
                ->setSubject($subject)
                ->setTextBody(' ')
                ->send()
            ) $success = true;
            else $success = false;

                
                $carts = Cart::find()->where(['user' => $userIp])->all();
                
                
                foreach($carts as $cart) {
                    $products .= $cart->product.",";

                    /*$products_bd = Products::find();
                    $products_bd_one = $products_bd->where(['id' => $cart->product])->one();*/
                    //$stock = $products_bd_one->stock;
                    //$stock = $stock - 1;
                   // $products_bd_one->stock = $stock;
                    //$products_bd_one->save();
                    /*$stock_bd = new Stock();
                    $stock_bd->product = $cart->product;
                    $stock_bd->status = 1;
                    $stock_bd->orderid = $cart->user;
                    $stock_bd->save();
                    $cart->delete();*/
                }
                $orders->products = $products;
                $orders->save();

                //$id = $orders->id;
                /*foreach($carts as $cart)
                {
                    $ords = new Orders();
                    $ords->lan_order = $id;
                    $ords->product = $cart->product;
                    $ords->quan = $cart->quan;
                    $ords->save();
                }*/
                

                $this->redirect($api->paymentURL);
            }
        }
    // ОПЛАТА

        if(Yii::$app->request->get('action') == 'change') {
            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $product = Yii::$app->request->get('id');
            $quan = Yii::$app->request->get('count');
            $cartUser = Cart::find()->where(['user' => $userIp])->andWhere(['product' => $product]);
            $count = Cart::find()->where(['user' => $userIp])->count();
            if($cartUser->exists()) {
                $find = $cartUser->one();
                $find->quan = $quan;
                $find->save();
            }
            $summa = $functions->getSummaCart($userIp);
            
            $values = [
                'id' => $product,
                'count' => $count,
                'summa' => $summa,
            ];
            return json_encode($values);
        }
        if(Yii::$app->request->get('action') == 'delete') {
            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $product = Yii::$app->request->get('id');
            $cartUser = Cart::find()->where(['user' => $userIp, 'product' => $product])->one();
            $cartUser->delete();

            $cart = Cart::find()->where(['user' => $userIp]);
            $count = Cart::find()->where(['user' => $userIp])->count();
            $carts = $cart->all();
            $summa = $functions->getSummaCart($userIp);
            
            $values = [
                'id' => $product,
                'count' => $count,
                'summa' => $summa,
            ];
            return json_encode($values);
        }
    
        

            $form = new FormCart();
            if ($form->load(Yii::$app->request->post())) {
                
            }
// -------------- ПОЧТА РОССИИ ------------------------
 
 

// ПОЧТА РОССИИ

            $system = mt_rand(1, 60000);
            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $carts = Cart::find()->where(['user' => $userIp])->all();
            return $this->render('checkout', [
                'carts' => $carts,
                'blockForm' => $form,
                'tinForm' => $tinkoff,
                'api' => $api,
                'mail' => $mes,
                'system' => $system,
            ]);
    }
    public function actionExample()
    {
        
        return $this->render('example', ['mes' => $mes]);
    }
    public function actionCart()
    {
        $functions = new Functions();
        if(Yii::$app->request->get('action') == 'change') {
            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $product = Yii::$app->request->get('id');
            $quan = Yii::$app->request->get('count');
            $cartUser = Cart::find()->where(['user' => $userIp])->andWhere(['product' => $product]);
            $count = Cart::find()->where(['user' => $userIp])->count();
            if($cartUser->exists()) {
                $find = $cartUser->one();
                $find->quan = $quan;
                $find->save();
            }
            $summa = $functions->getSummaCart($userIp);
            
            $values = [
                'id' => $product,
                'count' => $count,
                'summa' => $summa,
            ];
            return json_encode($values);
        }
        if(Yii::$app->request->get('action') == 'delete') {
            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $product = Yii::$app->request->get('id');
            $cartUsers = Cart::find()->where(['user' => $userIp])->andWhere(['product' => $product])->all();
            foreach($cartUsers as $cartUser) {
                $cartUser->delete();
            }
            $cart = Cart::find()->where(['user' => $userIp]);
            $count = Cart::find()->where(['user' => $userIp])->count();
            $carts = $cart->all();
            $summa = $functions->getSummaCart($userIp);
            
            $values = [
                'id' => $product,
                'count' => $count,
                'summa' => $summa,
            ];
            return json_encode($values);
        }
        $form = new FormPage();
        if ($form->load(Yii::$app->request->post())) {
            $name = $form->name;
            $phone = $form->phone;
            $email = $form->email;
            $plan = $form->plan;
            $btn = $form->btn;
            $orders = new Lan_orders();
            if($name != null) $orders->name = $name;
            if($phone != null) $orders->phone = $phone;
            if($email != null) $orders->email = $email;
            if($plan != null) $orders->plan = $plan;
            if($btn != null) $orders->btn = $btn;
            $orders->date_order = time();
            $orders->split = $page;
            $orders->status = 4;
            $orders->utm_source = $utm_source;
            $orders->utm_campaign = $utm_campaign;
            $orders->utm_medium = $utm_medium;
            $orders->utm_content = $utm_content;
            $orders->utm_term = $utm_term;
            
            if($orders->save()) {
            $admin = Options::find()->select(['name'])->one()->name;
            $mail = Options::find()->select(['email'])->one()->email;
            $mailname = Options::find()->select(['mailname'])->one()->mailname;
            $site = $mailname;
            $subject = 'Заполнена контактная форма с сайта '.$site;
            if(
            Yii::$app->mailer->compose('user', ['site' => $site, 'admin' => $admin, 'name' => $name, 'phone' => $phone, 'email' => $email, 'list' => $plan, 'btn' => $btn])
                ->setFrom(['info@wildcactus.ru' => $mailname])
                 ->setTo($mail)
                ->setSubject($subject)
                ->setTextBody(' ')
                ->send()
            ) $success = true;
            }
            else $success = false;
        }
        
        $session = Yii::$app->session;
        $userIp = $session->get('userIp');
        $carts = Cart::find()->where(['user' => $userIp])->all();
        $hits = Products::find()->where(['hit' => 1])->andWhere(['status' => 1])->orderby('orderby');
        $news = Products::find()->where(['new' => 1])->andWhere(['status' => 1])->orderby('orderby');
        return $this->render('cart', [
            'carts' => $carts,
            'hits' => $hits,
            'news' => $news,
            'pageForm' => $form,
        ]);
    }
    public function actionPayment()
    {
        $page = Pagepdg::find()->one();
        $payment = Blockpayment::find()->one();
        $delivery = Blockdelivery::find()->one();
        $garantees = Blockgarantees::find()->one();
        return $this->render('payment', [
            'page' => $page,
            'payment' => $payment,
            'delivery' => $delivery,
            'garantees' => $garantees,
        ]);
    }
    public function actionSearch()
    {
        $page = Pagesearch::find()->one();
        $form = new FormPageSearch();
        if ($form->load(Yii::$app->request->post())) {

            $search = Products::find()->where(['like', 'name', $form->search])->all();
        }
        return $this->render('search', [
            'page' => $page,
            'search' => $search,
        ]);
    }
    public function actionSuccess()
    {
        if(Yii::$app->request->get('Success'))
        {
            $OrderId = Yii::$app->request->get('OrderId');
            $amount = Yii::$app->request->get('Amount');
            $order = Lan_orders::find()->where(['system' => $OrderId])->one();
            $order->price = $amount / 100;
            $order->status = 4;
            $order->save();
            $id = $order->id;

            $session = Yii::$app->session;
            $userIp = $session->get('userIp');
            $carts = Cart::find()->where(['user' => $userIp])->all();
            
            
            foreach($carts as $cart) {
                //$products .= $cart->product.",";

                $products_bd = Products::find();
                $products_bd_one = $products_bd->where(['id' => $cart->product])->one();
                $stock = $products_bd_one->stock;
                $stock = $stock - 1;
                $products_bd_one->stock = $stock;
                $products_bd_one->save();
                $stock_bd = new Stock();
                $stock_bd->product = $cart->product;
                $stock_bd->status = 2;
                $stock_bd->orderid = $id;
                $stock_bd->save();
                $cart->delete();
            }

            
            /*foreach($carts as $cart)
            {
                $ords = new Orders();
                $ords->lan_order = $id;
                $ords->product = $cart->product;
                $ords->quan = $cart->quan;
                $ords->save();
            }*/
        }
        return $this->render('success', [
            //'page' => $page,
            //'search' => $search,
        ]);
    }
    public function actionFalse()
    {

        return $this->render('false', [
            //'page' => $page,
            //'search' => $search,
        ]);
    }
    public function actionPay()
    {
        return $this->render('pay', [

        ]);
    }


}
