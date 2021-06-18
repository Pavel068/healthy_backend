<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PatientsDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Данные пациентов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patients-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить данные пациента', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'id',
                'value' => function ($model) {
                    return \app\models\Users::find()->where(['id' => $model->id])->one()->full_name;
                }
            ],
            'birthday',
            'height',
            'weight',
            'extra:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
