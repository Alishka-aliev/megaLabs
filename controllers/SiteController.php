<?php

namespace app\controllers;

use app\models\agregator\HttpRequest;
use app\models\agregator\Tone;
use app\models\Cart;
use app\models\PhpExcelTones;
use app\models\ToneCollection;
use Yii;
use yii\base\InvalidParamException;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
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
        $get = Yii::$app->request->get('q');
        $toneList = array();
        $request = HttpRequest::getInstance();
        if ($get) {
            $result = true;
            $url = 'http://85.143.218.211:9090/search/?query=' . $get;
            $resp = $request->request($url);
            //Проверка на доступ.
            if ($request->isValid($resp->getStatusCode())) {
                /**
                 * $data -> object [0->array,1->array]
                 */
                $collection = new ToneCollection($resp->getData());
                $toneList = $collection->getToneData();
            } else {
                $result = false;
            }
        }
        if (Yii::$app->request->isAjax && $get) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $parial = '';
            foreach ($toneList as $tone) {
                $parial .= $this->renderPartial('//_template/tone.item.php', ['tone' => $tone]);
            }
            return ['resp' => $result, 'view' => $parial];
        }
        return $this->render('index',
            ['toneList' => $toneList,
                'get' => $get,
            ]
        );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * поиск.
     * @return array
     */
    public function actionSearch()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $q = Yii::$app->request->get('q');
            $list = ['test'];
            return $list;
        }
    }


    /**
     * @return array
     */
    public function actionExcel()
    {
        if (Yii::$app->request->isAjax) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $data = Yii::$app->request->get('data');
            $report = new PhpExcelTones($data);
            ob_start();
            $report->export();
            $xlsData = ob_get_contents();
            ob_end_clean();
            $response = array(
                'resp' => true,
                'file' => "data:application/vnd.ms-excel;base64," . base64_encode($xlsData)
            );
            die(json_encode($response));
        }
    }
}
