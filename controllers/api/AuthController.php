<?php

namespace app\controllers\api;

use app\models\Users;
use Yii;
use yii\base\Security;
use yii\web\BadRequestHttpException;
use yii\web\UnauthorizedHttpException;

class AuthController extends RestController
{
    public $modelClass = 'app\models\Users';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        array_push($behaviors['authenticator']['except'], 'login');
        return $behaviors;
    }

    public function actionLogin()
    {
        $password = Yii::$app->request->post('password');

        $user = Users::find()->where(['insurance_number' => Yii::$app->request->post('insurance_number')])->one();
        if (!$user) {
            throw new UnauthorizedHttpException();
        }

        if (Yii::$app->security->validatePassword($password, $user->password)) {
            return $user;
        } else {
            throw new UnauthorizedHttpException();
        }
    }

    public function actionLogout()
    {
        $user = Users::find()->where(['id' => Yii::$app->user->getId()])->one();
    }
}