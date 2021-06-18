<?php

namespace app\helpers;

use dosamigos\chartjs\ChartJs;

class ChartsHelper
{
    private static function getObservationChartsData($observation_id)
    {
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

        return $datasets;
    }

    public static function getObservationChart($observation_id)
    {
        $datasets = self::getObservationChartsData($observation_id);

        return ChartJs::widget([
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
    }
}