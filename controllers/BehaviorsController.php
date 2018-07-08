<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\components\MyBehaviors;

class BehaviorsController extends Controller {

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                /*'denyCallback' => function ($rule, $action) {
                    throw new \Exception('Нет доступа.');
                },*/
                'rules' => [
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['reg', 'login', 'activate-account'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['?']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['profile'],
                        'verbs' => ['GET', 'POST'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['logout'],
                        'verbs' => ['POST'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['site'],
                        'actions' => ['index', 'search', 'send-email', 'reset-password']
                    ],
                    /*[
                        'allow' => true,
                        'controllers' => ['widget-test'],
                        'actions' => ['index'],
                        'ips' => ['127.1.*'],
                        'matchCallback' => function ($rule, $action) {
                            return date('d-m') === '30-06';
                        }
                    ],*/
                    // catalog
                    [
                        'allow' => true,
                        'controllers' => ['catalog', 'place', 'post', 'section', 'author', 'format'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'verbs' => ['POST', 'GET'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'controllers' => ['catalog', 'place', 'post', 'section', 'author', 'format'],
                        'actions' => ['index', 'view'],
                        'verbs' => ['GET'],
                        'roles' => ['?']
                    ],

//                    [
//                        'allow' => true,
//                        'controllers' => ['catalog'],
//                        'actions' => ['index'],
//                        'verbs' => ['POST'],
//                        'roles' => ['?']
//                    ],
                ]
            ],
            'removeUnderscore' => [
                'class' => MyBehaviors::className(),
                'controller' => Yii::$app->controller->id,
                'action' => Yii::$app->controller->action->id,
                'removeUnderscore' => Yii::$app->request->get('search')
            ]
        ];
    }
}