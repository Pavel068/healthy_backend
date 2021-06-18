<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class _AdminController extends Controller
{
    public function beforeAction($action)
    {
        if (Yii::$app->user->identity == NULL) {
            $this->redirect(Url::base(true) . '/site/login');
        }

        return parent::beforeAction($action);
    }
}