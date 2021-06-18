<?php

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Observations */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Наблюдение', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="observations-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'doctor_id',
                'value' => function ($model) {
                    return \app\models\Users::find()->where(['id' => $model->doctor_id])->one()->full_name;
                }
            ],
            [
                'attribute' => 'patient_id',
                'value' => function ($model) {
                    return \app\models\Users::find()->where(['id' => $model->patient_id])->one()->full_name;
                }
            ],
            'start_date',
            'end_date',
            'result:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

    <h2>График</h2>
    <?php

    $data = \app\models\ObservationsData::find()->where(['observation_id' => 1])->all();
    $charts = [
        'top_pressure' => 'Верхнее давление',
        'bottom_pressure' => 'Нижнее давление',
        'pulse' => 'Пульс',
    ];
    $datasetsData = [];

    foreach ($charts as $chart_key => $chart_value) {
        foreach ($data as $item) {
            $datasetsData[$chart_key][] = [
                'x' => $item['created_at'],
                'y' => $item[$chart_key]
            ];
        }
    }

    $datasets = [];
    foreach (array_keys($datasetsData) as $key) {
        $datasets[] = [
            'label' => $charts[$key],
            'fill' => false,
            'barThickness' => 6,
            'maxBarThickness' => 6,
            'data' => $datasetsData[$key],
            'borderColor' => "rgba(" . rand(100, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ",0.8)"
        ];
    }

    if (count($datasetsData)) {
        echo ChartJs::widget([
            'type' => 'line',
            'id' => uniqid(true),
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => false,
            ],

            'clientOptions' => [
                'scales' => [
                    'xAxes' => [
                        [
                            'offset' => true,
                            'type' => 'time',
                            'distribution' => 'linear',
                            'time' => [
                                'unit' => 'day',
                                'displayFormats' => [
                                    'hour' => 'dd:MM',
                                ],
                                'tooltipFormat' => 'Y-MM-DD hh:mm:ss'
                            ]
                        ]
                    ],
                    'yAxes' => [
                        [
                            'ticks' => [
                                'min' => 0,
                                'suggestedMin' => 0,
                                'stepSize' => 1
                            ]
                        ]
                    ]
                ]
            ],
            'data' => [
                'datasets' => $datasets
            ],
        ]);
    } else {
        echo "<p class='text-muted'>Нет данных!</p>";
    }
    ?>

</div>
