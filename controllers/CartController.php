<?php

namespace app\controllers;

use app\models\Cart;
use app\models\ToneCollection;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class CartController extends Controller
{
    protected $_defaultSessionName = 'cartItem';

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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $toneList = [];
        $cartItem = Yii::$app->session->get(Cart::DEFAULT_SESSION_NAME);
        if ($cartItem) {
            $collection = new ToneCollection($cartItem);
            $toneList = $collection->getToneData();
        }


        return $this->render('index'
            , ['toneList' => $toneList,]
        );
    }


    /**
     * Добавление позиции в корзину
     * @return array
     */
    public function actionAdd()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post('data');
            $count = 0;
            $resp = true;
            $session = Yii::$app->session->get(Cart::DEFAULT_SESSION_NAME);

            if ($session && is_array($session)) {
                Yii::$app->session->set(Cart::DEFAULT_SESSION_NAME, array_unique(array_merge($data, $session)));
                $count = count(array_unique(array_merge($data, $session)));
            } else {
                Yii::$app->session->set(Cart::DEFAULT_SESSION_NAME, $data);
                $count = count($data);
            }
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ['resp' => $resp, 'counts' => $count];
        }
    }

    /**
     * Очистить корзину
     * @return array
     */
    public function actionClear()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post('data');
            $count = 0;
            $resp = true;
            $session = Yii::$app->session->get(Cart::DEFAULT_SESSION_NAME);
            if ($session && is_array($session)) {
                $arDiff = array_diff($session, $data);
                Yii::$app->session->set(Cart::DEFAULT_SESSION_NAME, $arDiff);
                $count = count($arDiff);
            } else {
                $resp = false;
            }

            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ['resp' => $resp, 'counts' => $count];
        }
    }

}
