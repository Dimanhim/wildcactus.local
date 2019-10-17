<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

use app\models\Pagemain;
use app\models\Pagepdg;
use app\models\Pagepromos;
use app\models\Pagesearch;
use app\models\Advmain;
use app\models\Blockadv;
use app\models\Blockdelivery;
use app\models\Blockgarantees;
use app\models\Blockpayment;

use app\models\Sef;
use app\models\Header;
use app\models\Utm;
use app\models\Lan_orders;
use app\models\Information;
use app\models\Options;
use app\models\Payment;
use app\models\FormCategories;
use app\models\FormPages;
use app\models\FormAdv;
use app\models\FormAlias;
use app\models\FormOptions;
use app\models\FormOrders;
use app\models\Categories;
use app\models\Products;
use app\models\Productimg;
use app\models\Productcats;
use app\models\Promos;
use app\models\Banners;
use app\models\Productpromo;
use app\models\Stock;
use app\models\Orders;
use app\models\FormNewImage;
use app\models\FormDeleteImage;
use app\models\FormAddProduct;
use app\models\FormSearchBarcode;
use app\models\FormSearchName;
use app\models\FormDeleteStock;
use app\models\FormAddStock;
use app\models\FormChangeStatus;
use app\models\FormPageMail;
use app\components\Functions;
use app\components\Translit;
use yii\data\Pagination;
use yii\web\UploadedFile;
use himiklab\sortablegrid\SortableGridAction;
use Imagine\Gd\Imagine;
use Imagine\Image\Box ;
use Imagine\Image\Point ;


class AdminController extends Controller
{
    public $layout = 'admin';

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
     if (in_array($action->id, ['index'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['orders'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['order'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['split'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['form'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['source'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['term'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['content'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['campaign'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['settings'])) {
     $this->enableCsrfValidation = false;
     }
     if (in_array($action->id, ['login'])) {
     $this->enableCsrfValidation = false;
     }
     return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $find = Lan_orders::find();
        $findAll = Lan_orders::find()->all();
        $findPayment = Payment::find();
        $findAllPayment = Payment::find()->all();
        $findOrders = Lan_orders::find()->all();

        // сортировка по датам
        $time = array();
        $i = 0;
        foreach($findOrders as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        $drop = Yii::$app->request->post('drop_date');
        if($drop != null) {
            $session = Yii::$app->session;
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        $functions = new Functions();
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        $message = $date['message'];
        // --сортировка по датам

        $countOrders = $find->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->count();
        $countWorkOrders = $find->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->andWhere(['status' => 3])->count();
        $countArchiveOrders = $find->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->andWhere(['status' => 1])->count();
        $countDoneOrders = $find->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->andWhere(['status' => 2])->count();
        $countAdminOrders = $find->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->andWhere(['status' => 5])->count();
        $totalAmount = 0;
        foreach($findAll as $all) {
            $totalAmount = $totalAmount + $all->price;
        }
        $totalSummPlus = 0;
        $findSummPlus = $findPayment->where(['action' => 'plus'])->andWhere("date >= $fromDate")->andWhere("date <= $toDate")->all();
        foreach($findSummPlus as $summPlus) {
            $totalSummPlus = $totalSummPlus + $summPlus->summa;
        }
        $totalSummMinus = 0;
        $findSummMinus = $findPayment->where(['action' => 'minus'])->andWhere("date >= $fromDate")->andWhere("date <= $toDate")->all();
        foreach($findSummMinus as $summMinus) {
            $totalSummMinus = $totalSummMinus + $summMinus->summa;
        }
        $profit = $totalSummPlus - $totalSummMinus;

        return $this->render('index', [
            'countOrders' => $countOrders,
            'countWorkOrders' => $countWorkOrders,
            'countArchiveOrders' => $countArchiveOrders,
            'countDoneOrders' => $countDoneOrders,
            'countAdminOrders' => $countAdminOrders,
            'totalAmount' => $totalAmount,
            'totalSummPlus' => $totalSummPlus,
            'totalSummMinus' => $totalSummMinus,
            'profit' => $profit,
            'date' => $date,
            'message' => $message,
        ]);
    }
    public function actionOrders()
    {
        $session = Yii::$app->session;
        $functions = new Functions();
        $orders = Lan_orders::find();
        
        // Получение переданных действий
        $findOrders = Lan_orders::find()->all();
        $id = Yii::$app->request->get('id');
        $id_delete = Yii::$app->request->post('id');
        $status = Yii::$app->request->get('status');
        $quan = Yii::$app->request->get('quan');
        $delete = Yii::$app->request->post('delete');
        $drop = Yii::$app->request->post('drop_date');
        $setFind = Lan_orders::findOne($id_delete);


        // Выборка по датам и по сплитам и др. параметрам
        $time = array();
        $i = 0;
        foreach($findOrders as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        if($drop != null) {
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        
        $orders = $orders->where("date_order >= $fromDate")->andWhere("date_order <= $toDate");
        if($quan == null) {
            if($status != null) { 
                $orders = $orders->andWhere(['status' => $status]);
                $message = $date['message']." <b>(".$functions->getStatus($status).")</b>";
            }
            else {
                //$orders = $orders->andWhere(['status' => 3]);
                $message = $date['message']." <b>(".$functions->getStatus(3).")</b>";
            }
        }
        else {
            
            $message = $date['message'];

            if(Yii::$app->request->get('split') != null) {
                $split = Yii::$app->request->get('split');
                $orders = $orders->andWhere(['split' => $split]);
                $message = $date['message']." <b>(По сплит-шаблонам)</b>";
            }

            if(Yii::$app->request->get('term') != null) {
                $term = Yii::$app->request->get('term');
                $orders = $orders->andWhere(['utm_term' => $term]);
                $message = $date['message']." <b>(Выборка по ключевым фразам)</b>";
            }

            if(Yii::$app->request->get('source') != null) {
                $source = Yii::$app->request->get('source');
                $orders = $orders->andWhere(['utm_source' => $source]);
                $message = $date['message']." <b>(Выборка по переходам с сайтов)</b>";
            }

            if(Yii::$app->request->get('form') != null) {
                $form = Yii::$app->request->get('form');
                $orders = $orders->andWhere(['btn' => $form]);
                $message = $date['message']." <b>(Выборка по заполненным формам)</b>";
            }

            if(Yii::$app->request->get('campaign') != null) {
                $campaign = Yii::$app->request->get('campaign');
                $orders = $orders->andWhere(['utm_campaign' => $campaign]);
                $message = $date['message']." <b>(Выборка по рекламным кампаниям)</b>";
            }

            if(Yii::$app->request->get('content') != null) {
                $content = Yii::$app->request->get('content');
                $orders = $orders->andWhere(['utm_content' => $content]);
                $message = $date['message']." <b>(Выборка по рекламным объявлениям)</b>";
            }   
        }   
        // Конец выборки по датам и др. параметрам

        $countOrders = $orders->count();
        
// Удаление заявки
        if($delete != null) {
            $actionsFind = Payment::find();
            if($actionsFind->where(['order' => $id])->exists()) {
                $i = 0;
                $allId = array();
                $finds = $actionsFind->where(['order' => $id])->all();
                foreach($finds as $find) {
                    $allId[$i] = $find->id;
                    $i++;
                }
                foreach($allId as $id) {
                    $delFind = Payment::findOne($id);
                    $delFind->delete();
                }
            }
            $setFind->delete();
        }
        
        $countName = $functions->getStatus($status);
        if($countName != "") $countName = $countName." - ";

        // Пагинация
        $pages = Options::find()->select(['count'])->one()->count;
        $pagination = new Pagination(
            [
                'defaultPageSize' => $pages,
                'totalCount' => $orders->count(),
            ]
        );
        $orders = $orders->orderBy('id DESC')->offset($pagination->offset)->limit($pagination->limit)->all();
        

        return $this->render('orders', [
            'orders' => $orders,
            'date' => $date,
            'time' => $time,
            'countName' => $countName,
            'pagination' => $pagination,
            'countOrders' => $countOrders,
            'message' => $message,
        ]);
    }
    public function actionOrder()
    {
        $functions = new Functions();
        $actions = new Payment();
        $actionsFind = Payment::find();
        $find = Lan_orders::find();
        $mailname = Options::find()->select(['mailname'])->one()->mailname;

        // Удаление операции
        $actionId = Yii::$app->request->get('delete');
        if($actionsFind->where(['id' => $actionId])->exists()) {
            $setFind = Payment::findOne($actionId);
            $setFind->delete();
        }
        
        // Редактирование данных заявки
        $id = Yii::$app->request->get('id');
        $name = Yii::$app->request->get('name');
        $ordername = Yii::$app->request->get('ordername');
        $phone = Yii::$app->request->get('phone');
        $email = Yii::$app->request->get('email');
        $status = Yii::$app->request->get('status');
        $price = Yii::$app->request->get('price');
        $comment = Yii::$app->request->get('comment');
        $products = Yii::$app->request->get('products');
        $setFind = Lan_orders::findOne($id);
        if($name != null) {
            $setFind->name = $name;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }
        if($ordername != null) {
            $setFind->ordername = $ordername;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }
        if($phone != null) {
            $setFind->phone = $phone;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }
        if($email != null) {
            $setFind->email = $email;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }
        if($status != null) {
            $setFind->status = $status;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }
        if($price != null) {
            $setFind->price = $price;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }
        if($comment != null) {
            $setFind->comment = $comment;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }
        if($products != null) {
            $setFind->products = $products;
            if($setFind->save()) $message = 'Заявка успешно отредактирована';   
        }

        // Получение данных заявки
        $order = $find->where(['id' => $id])->all();

        // Добавление данных об операциях
        if(Yii::$app->request->post('add_action') == 'true') {
            $id = Yii::$app->request->post('order_id');
            $action = Yii::$app->request->post('action');
            $action_name = Yii::$app->request->post('action_name');
            $action_summa = Yii::$app->request->post('action_summa');
            $actions->order = $id;
            $actions->action = $action;
            $actions->name = $action_name;
            $actions->summa = $action_summa;
            $actions->date = time();
             if($actions->save()) $message = 'Операция успешно добавлена'; 
        }

        // Получение данных об операциях
        $actionPlus = $actionsFind->where(['order' => $id])->andWhere(['action' => 'plus'])->all();
        $actionMinus = $actionsFind->where(['order' => $id])->andWhere(['action' => 'minus'])->all();
        //$ords = Orders::find()->where(['lan_order' => $id])->all();
        $ords = $functions->getProductsNames(Lan_orders::find()->where(['id' => $id])->one()->products);
        return $this->render('order', [
            'order' => $order[0],
            'message' => $message,
            'operations' => $operations,
            'actionPlus' => $actionPlus,
            'actionMinus' => $actionMinus,
            'ords' => $ords,
        ]);
    }
    public function actionAddorder()
    {
        $find = new Lan_orders();
        $name = Yii::$app->request->get('name');
        $phone = Yii::$app->request->get('phone');
        $email = Yii::$app->request->get('email');
        $price = Yii::$app->request->get('price');
        $utm_source = Yii::$app->request->get('utm_source');
        if(($name != null) && ($phone != null) && ($email != null) && ($utm_source != null)) {
            $find->name = $name;
            $find->phone = $phone;
            $find->email = $email;
            $find->price = $price;
            $find->status = 4;
            $find->split = 'Добавлен вручную';
            $find->btn = 'Добавлен вручную';
            $find->utm_source = 'Добавлен вручную';
            $find->utm_campaign = 'Добавлен вручную';
            $find->utm_medium = 'Добавлен вручную';
            $find->utm_term = 'Добавлен вручную';
            $find->utm_content = 'Добавлен вручную';
            $find->date_order = time();
            $find->utm_source = $utm_source;
            if($find->save()) $message = 'Заявка успешно добавлена';    
        } 
       
        return $this->render('addorder', [
            'message' => $message,
        ]);
    }
    
    public function actionStat()
    {
        return $this->render('stat');
    }
    public function actionSplit()
    {
//
        $session = Yii::$app->session;
        $functions = new Functions();
        $orders = Lan_orders::find();
        $order = Lan_orders::find()->all();
        $drop = Yii::$app->request->post('drop_date');
        if($drop != null) {
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        $time = array();
        $i = 0;
        foreach($order as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        $message = $date['message'];
        $orders = $orders->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->all();
//
        $orders_array = array();
        $i = 0;
        
        foreach($orders as $order) {
            $orders_array[$i] = $order->split;
            $i++;
        }
        $orders_unique = array_unique($orders_array);
        $countOrders = count($orders);

        return $this->render('split', [
            'orders_unique' => $orders_unique,
//
            'date' => $date,
            'message' => $date['message'],
            'orders' => $orders,
            'countOrders' => $countOrders
//
        ]);
    }
    public function actionForm()
    {
        $session = Yii::$app->session;
        $functions = new Functions();
        $orders = Lan_orders::find();
        $order = Lan_orders::find()->all();
        $drop = Yii::$app->request->post('drop_date');
        if($drop != null) {
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        $time = array();
        $i = 0;
        foreach($order as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        $message = $date['message'];
        $orders = $orders->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->all();
//
        $orders_array = array();
        $i = 0;
        
        foreach($orders as $order) {
            $orders_array[$i] = $order->btn;
            $i++;
        }
        $orders_unique = array_unique($orders_array);
        $countOrders = count($orders);

        return $this->render('form', [
            'orders_unique' => $orders_unique,
//
            'date' => $date,
            'message' => $date['message'],
            'orders' => $orders,
            'countOrders' => $countOrders
//
        ]);
    }
    public function actionSource()
    {
        $session = Yii::$app->session;
        $functions = new Functions();
        $orders = Lan_orders::find();
        $order = Lan_orders::find()->all();
        $drop = Yii::$app->request->post('drop_date');
        if($drop != null) {
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        $time = array();
        $i = 0;
        foreach($order as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        $message = $date['message'];
        $orders = $orders->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->all();
//
        $orders_array = array();
        $i = 0;
        
        foreach($orders as $order) {
            $orders_array[$i] = $order->utm_source;
            $i++;
        }
        $orders_unique = array_unique($orders_array);
        $countOrders = count($orders);

        return $this->render('source', [
            'orders_unique' => $orders_unique,
//
            'date' => $date,
            'message' => $date['message'],
            'orders' => $orders,
            'countOrders' => $countOrders
//
        ]);
    }
    public function actionCampaign()
    {
        $session = Yii::$app->session;
        $functions = new Functions();
        $orders = Lan_orders::find();
        $order = Lan_orders::find()->all();
        $drop = Yii::$app->request->post('drop_date');
        if($drop != null) {
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        $time = array();
        $i = 0;
        foreach($order as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        $message = $date['message'];
        $orders = $orders->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->all();
//
        $orders_array = array();
        $i = 0;
        
        foreach($orders as $order) {
            $orders_array[$i] = $order->utm_campaign;
            $i++;
        }
        $orders_unique = array_unique($orders_array);
        $countOrders = count($orders);

        return $this->render('campaign', [
            'orders_unique' => $orders_unique,
//
            'date' => $date,
            'message' => $date['message'],
            'orders' => $orders,
            'countOrders' => $countOrders
//
        ]);
    }
    public function actionContent()
    {
        $session = Yii::$app->session;
        $functions = new Functions();
        $orders = Lan_orders::find();
        $order = Lan_orders::find()->all();
        $drop = Yii::$app->request->post('drop_date');
        if($drop != null) {
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        $time = array();
        $i = 0;
        foreach($order as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        $message = $date['message'];
        $orders = $orders->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->all();
//
        $orders_array = array();
        $i = 0;
        
        foreach($orders as $order) {
            $orders_array[$i] = $order->utm_content;
            $i++;
        }
        $orders_unique = array_unique($orders_array);
        $countOrders = count($orders);

        return $this->render('content', [
            'orders_unique' => $orders_unique,
//
            'date' => $date,
            'message' => $date['message'],
            'orders' => $orders,
            'countOrders' => $countOrders
//
        ]);
    }
    public function actionTerm()
    {
        $session = Yii::$app->session;
        $functions = new Functions();
        $orders = Lan_orders::find();
        $order = Lan_orders::find()->all();
        $drop = Yii::$app->request->post('drop_date');
        if($drop != null) {
            $session->remove('fromOrdersDate');
            $session->remove('toOrdersDate');
        }
        $time = array();
        $i = 0;
        foreach($order as $get) {
            $time[$i] = $get->date_order;
            $i++;
        }
        $date = $functions->changeDate($time);
        $fromDate = $date['fromDate'];
        $toDate = $date['toDate'];
        $message = $date['message'];
        $orders = $orders->where("date_order >= $fromDate")->andWhere("date_order <= $toDate")->all();
//
        $orders_array = array();
        $i = 0;
        
        foreach($orders as $order) {
            $orders_array[$i] = $order->utm_term;
            $i++;
        }
        $orders_unique = array_unique($orders_array);
        $countOrders = count($orders);

        return $this->render('term', [
            'orders_unique' => $orders_unique,
//
            'date' => $date,
            'message' => $date['message'],
            'orders' => $orders,
            'countOrders' => $countOrders
//
        ]);
    }

    public function actionSettings()
    {
       
        // Редактирование данных
        $name = Yii::$app->request->post('name');
        $email = Yii::$app->request->post('email');
        $login = Yii::$app->request->post('login');
        $count = Yii::$app->request->post('count');
        $period = Yii::$app->request->post('period');
        $mailname = Yii::$app->request->post('mailname');
        $split1 = Yii::$app->request->post('split1');
        $split2 = Yii::$app->request->post('split2');
        $map = Yii::$app->request->post('map');
        $pass1 = md5(Yii::$app->request->post('password'));
        $pass2 = md5(Yii::$app->request->post('password2'));
        $setFind = Options::findOne(1);


        if(Yii::$app->request->post('edit_field') == 'true')
        {
            if($name != null) {
                $setFind->name = $name;
                if($setFind->save()) $message = 'Имя успешно отредактировано';   
            }
            if($email != null) {
                $setFind->email = $email;
                if($setFind->save()) $message = 'Email успешно отредактирован';   
            }
            if($login != null) {
                $setFind->login = $login;
                if($setFind->save()) $message = 'Логин успешно отредактирован';   
            }
            if($count != null) {
                $setFind->count = $count;
                if($setFind->save()) $message = 'Количество заявок успешно отредактировано';   
            }
            if($period != null) {
                $setFind->period = $period;
                if($setFind->save()) $message = 'Период успешно отредактирован';   
            }
            if($mailname != null) {
                $setFind->mailname = $mailname;
                if($setFind->save()) $message = 'Отправитель успешно отредактирован';   
            }
            if($split1 != null) {
                $setFind->split1 = $split1;
                if($setFind->save()) $message = 'Split шаблон А успешно отредактирован';   
            }
            if($split2 != null) {
                $setFind->split2 = $split2;
                if($setFind->save()) $message = 'Split шаблон Б успешно отредактирован';   
            }
            if($map != null) {
                $setFind->map = $map;
                if($setFind->save()) $message = 'Карта успешно отредактирована';   
            }
        }
        if(Yii::$app->request->post('change_pass') == 'true')
        {
            if($pass1 == $pass2)
            {
                $setFind->password = $pass1;
                if($setFind->save()) $message = 'Пароль успешно изменен';
                else $message = 'Ошибка изменения пароля';
            }
            else $message = 'Пароли не совпадают. Попробуйте еще раз';
        }
        $form = new FormOptions();
        if ($form->load(Yii::$app->request->post())) {
            $options = Options::find()->one();
            $options->siteemail = $form->siteemail;
            $options->phone = $form->phone;
            $options->req = $form->req;
            $options->insta = $form->insta;
            if($options->save()) $message = 'Данные успешно сохранены';
        }
        $options = Options::find()->one();

        return $this->render('settings', [
            'options' => $options,
            'infoForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionCategories()
    {
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $id = $form->id;
            $deleteCat = Categories::findOne($id);
            $categories = Categories::find()->all();
            foreach($categories as $category) {
                if($category->parent == $id) {
                    $category->parent = null;
                    $category->level = 1;
                    $category->save();
                }
            }
            $productcats = Productcats::find()->where(['category' => $id])->all();
            if($productcats) {
                foreach($productcats as $productcat) {
                    $productcat->delete();
                }
            }
            $products = Products::find()->where(['category' => $id])->all();
            foreach($products as $product) {
                $product->category = null;
                $product->save();
            }
            if($deleteCat->img) unlink(DELPATH.$deleteCat->img);
            if($deleteCat->delete()) $message = "Категория успешно удалена";
            $sef = Sef::find()->where(['link' => "site/category?id=".$id])->one();
            if($sef->delete()) $message .= ". Ссылка успешно удалена";
        }
        $categories = Categories::find()->orderby('orderby')->all();
        $products = Products::find();
        return $this->render('categories', [
            'categories' => $categories,
            'products' => $products,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionAddcategory()
    {
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $translit = new Translit();
            $functions = new Functions();
            $block = new Categories();
            $block->name = trim($form->name);
            $block->description = trim($form->description);
            $block->parent = $form->parent;

            
            
            $block->status = 1;
            if($form->parent != null) $block->level = 2;
            else $block->level = 1;

            if($form->parent != null)
            {
                $parent_cat_name = $functions->getCategory($form->parent)->name;
                $alias = $translit->translate($parent_cat_name).'-'.$translit->translate($form->name);
                $block->alias = $alias;
            }



            $cat = Sef::find()->where(['linksef' => trim($alias)]);
            if($cat->exists()) {
                $message = "Такой алиас уже существует, попробуйте придумать другой";
            } else {
                if($block->save()) {
                    $message = 'Категория успешно добавлена';
                    $sef = new Sef();
                    $maxId = Categories::find()->max('id');
                    $sef->linksef = trim($alias);
                    $sef->link = "site/category?id=".$maxId;
                    $sef->save();
                } 
            }
        }
        $categories = Categories::find()->orderby('orderby')->all();
        return $this->render('addcategory', [
            'categories' => $categories,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionCategory()
    {
        $functions = new Functions();
        $translit = new Translit();
        $id = Yii::$app->request->get('id');
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $category = Categories::find()->where(['id' => $id])->one();
            $oldAlias = $category->alias;
            $category->name = trim($form->name);
            $category->description = $form->description;
            $category->alias = $translit->translate(trim($form->name));
            $category->level = $form->level;
            $category->status = $form->status;
            $category->parent = $form->parent;
            if($form->parent != null) $category->level = 2;
            else $category->level = 1;
            $category->orderby = $form->orderby;
            $link = "site/category?id=".$id;
            if($functions->isSefExists($oldAlias, $link)) {
                $message = "Такой алиас уже существует. Попробуйте другой";
            } else {
                $form->file = UploadedFile::getInstance($form, 'file');
                if($form->file) {
                    $form->file->saveAs('admin-images/category-'.$id.'.'. $form->file->extension);
                    $category->img = 'category-'.$id.'.'. $form->file->extension;
                }
                if($category->save()) $message = 'Категория успешно отредактирована';
                if($category->alias != $oldAlias) {
                    if(Sef::find()->where(['link' => $link])->exists()) {
                        $sef = Sef::find()->where(['link' => $link])->one();
                    }
                    else {
                        $sef = new Sef();
                    }
                    $sef->link = "site/category?id=".$id;
                    $sef->linksef = $category->alias;
                    if($sef->save()) $message .= '. Ссылка успешно отредактирована'; 
                }
            }
        }
        $category = Categories::find()->where(['id' => $id])->one();
        $categories = Categories::find()->all();
        $undercategories = Categories::find()->where(['parent' => $id])->all();
        $products = Products::find()->where(['category' => $id])->all();
        return $this->render('category', [
            'category' => $category,
            'categories' => $categories,
            'products' => $products,
            'undercategories' => $undercategories,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionProducts()
    {
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $id = $form->id;
            $deleteCat = Products::findOne($id);
            $sef = Sef::find()->where(['linksef' => $deleteCat->alias]);
            $cats = Productcats::find()->where(['product' => $id])->all();
            if($cats) {
                foreach($cats as $cat) {
                    $cat->delete();
                }
            }
            if($deleteCat->img) unlink(DELPATH.$deleteCat->img);
            $numbers = Productimg::find()->where(['product' => $id])->all();
            foreach($numbers as $number) {
                if($number->img) unlink(DELPATH.$number->img);
                $number->delete();
            }
            if($deleteCat->delete()) {
                if($sef->exists()) $sef->one()->delete();
                $message = "Товар успешно удален";
            } 
        }
        $productcats = Productcats::find();
        $products = Products::find()->orderby('orderby')->all();
        $stock = Stock::find()->where(['product' => $id])->andWhere(['status' => 1])->all();
        /*$pagination = new Pagination(
            [
                'defaultPageSize' => 100,
                'totalCount' => $products->count(),
            ]
        );*/
        //$products = $products->orderby('orderby')->offset($pagination->offset)->limit($pagination->limit)->all();
        
        return $this->render('products', [
            'products' => $products,
            'productcats' => $productcats,
            'blockForm' => $form,
            'message' => $message,
            'pagination' => $pagination
        ]);
    }
    public function actionProductReserve()
    {
        $stocks = Stock::find()->where(['status' => 2])->all();
        $products = Products::find()->where(['id' => 72]);
        foreach($stocks as $stock) {
            $products->andWhere(['id' => $stock->product]);
        }
        $products = $products->orderby('orderby')->all();
        
        return $this->render('product-reserve', [
            'products' => $products,
            'productcats' => $productcats,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionAddproduct()
    {
        $addform = new FormAddProduct();
        if ($addform->load(Yii::$app->request->post())) {
            $searchBarcode = Products::find()->where(['barcode' => $addform->barcode]);
            if($searchBarcode->exists()) {
                $search = $searchBarcode->one(); 
                $stock = $search->stock;
                $search->stock = $stock + 1;
                $search->price = $addform->price;
                if($search->save()) {
                    $message = 'Товар успешно добавлен на склад';
                    $product = Products::find()->where(['id' => $search->id])->one();
                    $editNew = $search->id;
                }
            }
            else {
                $block = new Products();
                $block->barcode = trim($addform->barcode);
                $block->status = 0;
                $block->hit = 0;
                $block->new = 0;
                $block->promo = 0;
                $block->status = 1;
                $block->stock = 1;
                if($block->save()) {
                    $message = 'Новый товар успешно добавлен (в т.ч. на склад)';
                    $maxId = Products::find()->max('id');
                    $product = Products::find()->where(['id' => $maxId])->one();
                    $editNew = $maxId;
                }    
            }
            
        }
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $id = $form->id;
            $product = Products::find()->where(['id' => $id])->one();
            $product->name = $form->name;
            $product->description = $form->description;
            $translit = new Translit();
            $alias = $translit->translate(trim($form->name));
            $product->alias = $alias;
            $product->status = $form->status;
            $product->hit = $form->hit;
            $product->new = $form->new;
            $product->promo = $form->promo;
            $product->price = trim($form->price);
            $product->series = trim($form->series);
            $product->model = trim($form->model);
            $product->material = trim($form->material);
            //$product->category = $form->category;
            $cats = $form->category;
            if(isset($cats)) {
                foreach($cats as $cat) {
                    if(Productcats::find()->where(['product' => $product->id, 'category' => $cat])->exists()) {
                        $productcats = Productcats::find()->where(['product' => $product->id, 'category' => $cat])->one();
                    }
                    else $productcats = new Productcats();
                    $productcats->product = $product->id;
                    $productcats->category = $cat;
                    $productcats->save();
                }
            }
            $product->orderby = $form->orderby;
            $form->file = UploadedFile::getInstance($form, 'file');
            if(Sef::find()->where(['linksef' => $form->alias])->exists()) {
                $message = "Такой алиас уже существует. Попробуйте другой";
            } else {
                if($form->file) {
                    $form->file->saveAs('admin-images/product-'.$id.'.'. $form->file->extension);
                    $product->img = 'product-'.$id.'.'. $form->file->extension;
                }
                $sef = new Sef();
                $sef->link = "site/product?id=".$id;
                $sef->linksef = $alias;
                if($product->save() && $sef->save()) $message = 'Товар успешно отредактирован';   
            }
            $product = Products::find()->where(['id' => $product->id])->one();

        }
        $cats = Productcats::find()->where(['product' => $product->id])->all();
        $categories = Categories::find()->all();
        $promos = Promos::find()->all();

        return $this->render('addproduct', [
            'addForm' => $addform,
            'blockForm' => $form,
            'product' => $product,
            'categories' => $categories,
            'cats' => $cats,
            'promos' => $promos,
            'editNew' => $editNew,
            'message' => $message,
        ]);
    }
    public function actionSearchproduct()
    {
        $addform = new FormSearchBarcode();
        if ($addform->load(Yii::$app->request->post())) {
            if(Products::find()->where(['barcode' => $addform->barcode])->one()) {
                $product = Products::find()->where(['barcode' => $addform->barcode])->one();
                $pages = 'barcode';
            }
            else $message = "По Вашему запросу ничего не найдено";
        }
        $searchProduct = new FormSearchName();
        if ($searchProduct->load(Yii::$app->request->post())) {
            if(Products::find()->where(['like', 'name', $searchProduct->name])->one()) {
                $product = Products::find()->where(['like', 'name', $searchProduct->name])->all();
                $pages = 'names';
            }
            else $message = "По Вашему запросу ничего не найдено";
        }
        return $this->render('searchproduct', [
            'product' => $product,
            'addForm' => $addform,
            'searchProduct' => $searchProduct,
            'blockForm' => $form,
            'product' => $product,
            'categories' => $categories,
            'promos' => $promos,
            'editNew' => $editNew,
            'message' => $message,
            'pages' => $pages,
        ]);
    }
    public function actionProduct()
    {
        $functions = new Functions();
        $translit = new Translit();
        $id = Yii::$app->request->get('id');
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $product = Products::find()->where(['id' => $id])->one();
            $oldAlias = $product->alias;
            $product->name = trim($form->name);
            $product->description = trim($form->description);
            $product->alias = $translit->translate(trim($form->name));
            $product->status = $form->status;
            $product->price = trim($form->price);
            $product->hit = $form->hit;
            $product->new = $form->new;
            $product->promo = $form->promo;
            $product->series = trim($form->series);
            $product->model = trim($form->model);
            $product->material = trim($form->material);
            //$product->category = $form->category;
            // удаляем все записи
            $dels = Productcats::find()->where(['product' => $product->id])->all();
            if($dels) {
                foreach($dels as $del) {
                    $del->delete();
                }
            }
            $cats = $form->category;
            if(isset($cats)) {
                foreach($cats as $cat) {
                    if(Productcats::find()->where(['product' => $product->id, 'category' => $cat])->exists()) {
                        $productcats = Productcats::find()->where(['product' => $product->id, 'category' => $cat])->one();
                    }
                    else $productcats = new Productcats();
                    $productcats->product = $product->id;
                    $productcats->category = $cat;
                    $productcats->save();
                }
            }


            $product->orderby = $form->orderby;
            $link = "site/product?id=".$id;
            if($functions->isSefExists($oldAlias, $link)) {
                $message = "Такой алиас уже существует. Попробуйте другой";
            } else {
                $form->file = UploadedFile::getInstance($form, 'file');
                if($form->file) {
                    $file_name = 'product-'.$id;
                    $file_extension = '.'.$form->file->extension;
                    $form->file->saveAs('admin-images/'.$file_name.$file_extension);
                    $product->img = $file_name.$file_extension;
                    $im = new Imagine();
                    $img = $im->open('admin-images/'.$file_name.$file_extension);
                    $img->resize(new Box(220,330))
                        ->save( 'admin-images/'.$file_name.'-small'.$file_extension);
                    $product->preview = $file_name.'-small'.$file_extension;
                }
                
                if($product->save()) $message = 'Товар успешно отредактирован';   
                if($product->alias != $oldAlias) {
                    if(Sef::find()->where(['link' => $link])->exists()) {
                        $sef = Sef::find()->where(['link' => $link])->one();
                    }
                    else {
                        $sef = new Sef();
                    }
                    $sef->link = "site/product?id=".$id;
                    $sef->linksef = $product->alias;
                    if($sef->save()) $message .= '. Ссылка успешно отредактирована'; 
                }
                 
                   
            }
        }
        $formImage = new FormNewImage();
        if ($formImage->load(Yii::$app->request->post())) {
            $images = new Productimg();
            $formImage->file = UploadedFile::getInstance($formImage, 'file');
            if($formImage->file) {
                $number = Productimg::find()->where(['product' => $id])->count();
                $formImage->file->saveAs('admin-images/product-'.$id.'-'.($number + 1).'.'. $formImage->file->extension);
                $images->img = 'product-'.$id.'-'.($number + 1).'.'. $formImage->file->extension;
                $images->product = $id;
            }
            if($images->save()) $message = 'Изображение успешно добавлено';
        }
        
        $formDelete = new FormDeleteImage();
        if ($formDelete->load(Yii::$app->request->post())) {
            $delImage = Productimg::find()->where(['id' => $formDelete->id])->one();
            if($delImage->img) unlink(DELPATH.$delImage->img);
            if($delImage->delete()) $message = 'Изображение успешно удалено';
        }
        $product = Products::find()->where(['id' => $id])->one();
        $products = Products::find()->all();
        $categories = Categories::find()->all();
        $pc = Productcats::find()->where(['product' => $id])->all();
        $images = Productimg::find()->where(['product' => $id])->all();
        $promos = Promos::find()->all();
        return $this->render('product', [
            'product' => $product,
            'products' => $products,
            'categories' => $categories,
            'promos' => $promos,
            'images' => $images,
            'blockForm' => $form,
            'uploadImage' => $formImage,
            'formDelete' => $formDelete,
            'message' => $message,
            'cats' => $pc,
        ]);
    }
    public function actionProductimg()
    {
        $id = Yii::$app->request->get('id');
        $product = Yii::$app->request->get('product');
        $formImage = new FormNewImage();
        if ($formImage->load(Yii::$app->request->post())) {
            $image = Productimg::find()->where(['id' => $id])->one();
            $formImage->file = UploadedFile::getInstance($formImage, 'file');
            if($formImage->file) {
                $formImage->file->saveAs('admin-images/product-'.$image->product.'-'.$image->id.'.'. $formImage->file->extension);
                $image->img = 'product-'.$image->product.'-'.$image->id.'.'. $formImage->file->extension;
            }
            if($image->save()) $message = 'Изображение успешно изменено';
        }
        $image = Productimg::find()->where(['id' => $id])->one();
        return $this->render('productimg', [
            'image' => $image,
            'product' => $product,
            'uploadImage' => $formImage,
            'message' => $message,
        ]);
    }
    public function actionPromos()
    {
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $id = $form->id;
            $deleteCat = Promos::findOne($id);
            $products = Products::find()->where(['promo' => $id])->all();
            foreach($products as $product) {
                if($product->promo == $id) {
                    $product->promo = null;
                    $product->save();
                }
            }
            if($deleteCat->img) unlink(DELPATH.$deleteCat->img);
            if($deleteCat->delete()) $message = "Акция успешно удалена";
        }
        $products = Products::find();
        $promos = Promos::find()->all();
        return $this->render('promos', [
            'promos' => $promos,
            'products' => $products,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionPromo()
    {
        $id = Yii::$app->request->get('id');
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $promo = Promos::find()->where(['id' => $id])->one();
            $promo->name = $form->name;
            $promo->text1 = $form->text1;
            $promo->text2 = $form->text2;
            $promo->status = $form->status;
            $form->file = UploadedFile::getInstance($form, 'file');
            if($form->file) {
                $form->file->saveAs('admin-images/promo-'.$id.'.'. $form->file->extension);
                $promo->img = 'promo-'.$id.'.'. $form->file->extension;
            }
            if($promo->save()) $message = 'Акция успешно отредактирована';
        }
        $promo = Promos::find()->where(['id' => $id])->one();
        return $this->render('promo', [
            'promo' => $promo,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionAddpromo()
    {

        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $block = new Promos();
            $block->name = $form->name;
            $block->status = $form->status;
            if($block->save()) $message = 'Акция успешно добавлена';
        }
        
        return $this->render('addpromo', [
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionStock()
    {
        $deleteStock = new FormDeleteStock();
        if ($deleteStock->load(Yii::$app->request->post())) {
            $id = $deleteStock->id;
            $product = Products::find()->where(['id' => $id])->one();
            $number = $product->stock;
            $product->stock = $number - 1;
            if($product->save()) $message = "Единица товара успешно удалена со склада";
            $values = [
                'id' => $id,
                'value' => $number - 1,
            ];
            return json_encode($values);
        }
        $addStock = new FormAddStock();
        if ($addStock->load(Yii::$app->request->post())) {
            $id = $addStock->id;
            $product = Products::find()->where(['id' => $id])->one();
            $number = $product->stock;
            $product->stock = $number + 1;
            if($product->save()) $message = "Единица товара успешно удалена со склада";

            $values = [
                'id' => $id,
                'value' => $number + 1,
            ];
            return json_encode($values);
        }
        $changeStatus = new FormChangeStatus();
        if ($changeStatus->load(Yii::$app->request->post())) {
            $id = $changeStatus->id;
            $stock = Stock::find()->where(['id' => $id])->one();
            if($changeStatus->status == 1)
            {
                //--- раскомментировать для тестовой отправки товара - отправить добавляет 1 на склад
                /*$prods = Products::find()->where(['id' => $stock->product])->all();
                foreach($prods as $prod)
                {
                    $quan = $prod->stock;
                    $prod->stock = $quan + 1;
                    $prod->save();
                    $stock->delete();
                }*/
                $stock->delete();
            }
        }
        $products = Products::find()->all();
        $stocks = Stock::find()->all();
        /*$pagination = new Pagination(
            [
                'defaultPageSize' => 20,
                'totalCount' => $products->count(),
            ]
        );*/
        //$products = $products->orderby('orderby')->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('stock', [
            'stocks' => $stocks,
            'products' => $products,
            'deleteStock' => $deleteStock,
            'addStock' => $addStock,
            'changeStatus' => $changeStatus,
            'message' => $message,
            'pagination' => $pagination,
        ]);
    }
    public function actionItemstock()
    {
        $id = Yii::$app->request->get('id');
        $form = new FormCategories();

        $product = Products::find()->where(['id' =>$id])->one();
        $stockOne = Stock::find()->where(['product' => $id])->andWhere(['status' => 1])->count();
        $stockSecond = Stock::find()->where(['product' => $id])->andWhere(['status' => 2])->count();
        return $this->render('itemstock', [
            'stockOne' => $stockOne,
            'stockSecond' => $stockSecond,
            'product' => $product,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionBanners()
    {
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $id = $form->id;
            $deleteCat = Banners::findOne($id);
            if($deleteCat->img) unlink(DELPATH.$deleteCat->img);
            if($deleteCat->delete()) $message = "Баннер успешно удален";
        }
        $banners = Banners::find()->all();
        return $this->render('banners', [
            'banners' => $banners,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionBanner()
    {
        $id = Yii::$app->request->get('id');
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $banner = Banners::find()->where(['id' => $id])->one();
            $banner->status = $form->status;
            $form->file = UploadedFile::getInstance($form, 'file');
            if($form->file) {
                $form->file->saveAs('admin-images/banner-'.$id.'.'. $form->file->extension);
                $banner->img = 'banner-'.$id.'.'. $form->file->extension;
            }
            if($banner->save()) $message = 'Баннер успешно отредактирован';
        }
        $banner = Banners::find()->where(['id' => $id])->one();
        return $this->render('banner', [
            'banner' => $banner,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionAddbanner()
    {
        $form = new FormCategories();
        if ($form->load(Yii::$app->request->post())) {
            $block = new Banners();
            $form->file = UploadedFile::getInstance($form, 'file');
            if($form->file) {
                $id = (Banners::find()->max('id')) +1;
                $form->file->saveAs('admin-images/banner-'.$id.'.'. $form->file->extension);
                $block->img = 'banner-'.$id.'.'. $form->file->extension;    
            }
            $block->status = $form->status;
            if($block->save()) $message = 'Баннер успешно добавлен';
        }
        
        return $this->render('addbanner', [
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionPagePromos()
    {
        $form = new FormPages();
        if ($form->load(Yii::$app->request->post())) {
            if(Pagepromos::find()->exists()) {
                $block = Pagepromos::find()->one();
            }
            else {
                $block = new Pagepromos();
            }
            $block->title = $form->title;
            $block->route = $form->route;
            $block->metadesc = $form->metadesc;
            if($block->save()) $message = 'Страница успешно отредактирована';
        }
        $promo = Pagepromos::find()->one();
        
        return $this->render('page-promos', [
            'promo' => $promo,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionPageMain()
    {
        $advForm = new FormAdv();
        $form = new FormPages();
        if ($form->load(Yii::$app->request->post())) {
            if(Pagemain::find()->exists()) {
                $block = Pagemain::find()->one();
            }
            else {
                $block = new Pagemain();
            }
            $block->title = $form->title;
            $block->metadesc = $form->metadesc;
            $block->header = $form->header;
            $block->about = $form->about;
            $block->text = $form->text;
            $block->adv = $form->adv;
            if($block->save()) $message = 'Страница успешно отредактирована';
        }
        if ($advForm->load(Yii::$app->request->post())) {
            if(Advmain::find()->exists()) {
                $block = Advmain::find()->one();
            }
            else {
                $block = new Advmain();
            }
            $block->a1h = $advForm->a1h;
            $block->a1t = $advForm->a1t;
            $block->a2h = $advForm->a2h;
            $block->a2t = $advForm->a2t;
            $block->a3h = $advForm->a3h;
            $block->a3t = $advForm->a3t;
            $block->a4h = $advForm->a4h;
            $block->a4t = $advForm->a4t;
            $block->a5h = $advForm->a5h;
            $block->a5t = $advForm->a5t;
            $block->a6h = $advForm->a6h;
            $block->a6t = $advForm->a6t;
            if($block->save()) $message = 'Страница успешно отредактирована';
        }
        $page = Pagemain::find()->one();
        $adv = Advmain::find()->one();
        return $this->render('page-main', [
            'page' => $page,
            'blockForm' => $form,
            'advForm' => $advForm,
            'adv' => $adv,
            'message' => $message,
        ]);
    }
    public function actionPageProduct()
    {
        $form = new FormPages();
        if ($form->load(Yii::$app->request->post())) {
            $page = Pagemain::find()->one();
            $page->header_product = $form->header_product;
            $page->text_product = $form->text_product;
            if($page->save()) $message = "Страница успешно отредактирована";
        }
        $page = Pagemain::find()->one();
        return $this->render('page-product', [
            'page' => $page,
            'blockForm' => $form,
            'advForm' => $advForm,
            'adv' => $adv,
            'message' => $message,
        ]);
    }
    public function actionPageOplata()
    {
        $form = new FormPages();

        if ($form->load(Yii::$app->request->post())) {
        // Блок Оплата
            if($form->page == 'payment') {
                if(Blockpayment::find()->exists()) {
                    $block = Blockpayment::find()->one();
                }
                else {
                    $block = new Blockpayment();
                }
                $block->header = $form->header;
                $block->text = $form->text;
                if($block->save()) $message = 'Блок Оплаты успешно отредактирован';
            }
        // Блок Доставка
            elseif($form->page == 'delivery') {
                if(Blockdelivery::find()->exists()) {
                    $block = Blockdelivery::find()->one();
                }
                else {
                    $block = new Blockdelivery();
                }
                $block->text = $form->text;
                $block->headerfirst = $form->headerfirst;
                $block->textfirst = $form->textfirst;
                $block->headersecond = $form->headersecond;
                $block->textsecond = $form->textsecond;
                if($block->save()) $message = 'Блок Доставка успешно отредактирован';
            }
        // Блок Гарантии
            elseif($form->page == 'garantees') {
                if(Blockgarantees::find()->exists()) {
                    $block = Blockgarantees::find()->one();
                }
                else {
                    $block = new Blockgarantees();
                }
                $block->headerone = $form->headerone;
                $block->headertwo = $form->headertwo;
                $block->headerthree = $form->headerthree;
                $block->description = $form->description;
                $block->textone = $form->textone;
                $block->texttwo = $form->texttwo;
                $block->textthree = $form->textthree;
                $block->textfour = $form->textfour;
                $block->textfive = $form->textfive;
                $block->textsix = $form->textsix;
                $block->textseven = $form->textseven;
                $block->texteight = $form->texteight;
                if($block->save()) $message = 'Блок Гарантии успешно отредактирован';
            }
        // Общая инфа по странице
            else {
                if(Pagepdg::find()->exists()) {
                    $block = Pagepdg::find()->one();
                }
                else {
                    $block = new Pagepdg();
                }
                $block->title = $form->title;
                $block->route = $form->route;
                $block->metadesc = $form->metadesc;
                if($block->save()) $message = 'Страница успешно отредактирована';    
            }
            
        }
        $page = Pagepdg::find()->one();
        $payment = Blockpayment::find()->one();
        $delivery = Blockdelivery::find()->one();
        $garantees = Blockgarantees::find()->one();
        return $this->render('page-oplata', [
            'page' => $page,
            'payment' => $payment,
            'delivery' => $delivery,
            'garantees' => $garantees,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }
    public function actionPageSearch()
    {
        $form = new FormPages();

        if ($form->load(Yii::$app->request->post())) {
    // Общая инфа по странице
            if(Pagesearch::find()->exists()) {
                $block = Pagesearch::find()->one();
            }
            else {
                $block = new Pagesearch();
            }
            $block->title = $form->title;
            $block->route = $form->route;
            $block->metadesc = $form->metadesc;
            if($block->save()) $message = 'Страница успешно отредактирована';
        }
        $page = Pagesearch::find()->one();
        return $this->render('page-search', [
            'page' => $page,
            'blockForm' => $form,
            'message' => $message,
        ]);
    }

















































    public function actionLogin()
    {
        $this->layout = 'login';
        
        $admin = new Functions();

        if(Yii::$app->request->post('auth') == 'true') {
            $login = Yii::$app->request->post('login');
            $password = Yii::$app->request->post('password');
            $password = md5($password);
            $login_bd = Options::find()->select(['login'])->one()->login;
            $password_bd = Options::find()->select(['password'])->one()->password;
            if($login == $login_bd) {
                if($password == $password_bd) {
                    $session = Yii::$app->session;
                    $session->set('loginLand', $login);
                    $session->set('passwordLand', $password);
                    $admin->redirectLogin('/admin');
                }
                else $message = 'Неверный пароль';
            }
            else {
                $message = 'Неверный логин';
            } 
                  
        }

        return $this->render('login', [
            'message' => $message,
        ]);
    }

    public function actionExit() {
        $admin = new Functions();
        $session = Yii::$app->session;
        $session->remove('loginLand');
        $session->remove('passwordLand');
        $admin->redirectLogin(Yii::$app->urlManager->createUrl(['admin/login']));

    }
    public function actionHelp() {
        return $this->render('help');
    }

}