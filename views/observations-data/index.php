<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObservationsDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Данные наблюдений';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="observations-data-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'observation_id',
            'top_pressure',
            'bottom_pressure',
            'pulse',
            'created_at',
        ],
    ]); ?>


</div>
