<?php

namespace app\controllers\api;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;

class RestController extends \yii\rest\ActiveController
{
    protected $bearer;
    protected $permissions = [];

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    public function beforeAction($action)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            Yii::$app->request->getHeaders()['authorization'] ? $this->bearer = explode(" ", Yii::$app->request->getHeaders()['authorization'])[1] : $this->bearer = false;
        } catch (\Exception $e) {
            throw new UnauthorizedHttpException();
        }

        return parent::beforeAction($action);
    }

    public function actions()
    {
        $actions = parent::actions();

        $actions['options'] = [
            'class' => 'yii\rest\OptionsAction',
        ];

        unset($actions['index']);
        unset($actions['view']);
        unset($actions['create']);
        unset($actions['delete']);
        unset($actions['update']);

        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
            'cors' => [
                'Origin' => ['*'],
                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                'Access-Control-Request-Headers' => ['*'],
            ],
        ];

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
            'except' => ['options']
        ];

        return $behaviors;
    }

    protected function verbs()
    {
        return [
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
            'view' => ['GET', 'HEAD'],
            'index' => ['GET', 'HEAD'],
        ];
    }
}