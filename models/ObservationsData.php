<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "observations_data".
 *
 * @property int $id
 * @property int $observation_id
 * @property int $top_pressure
 * @property int $bottom_pressure
 * @property int $pulse
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Observations $observation
 */
class ObservationsData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'observations_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['observation_id', 'top_pressure', 'bottom_pressure', 'pulse'], 'required'],
            [['observation_id', 'top_pressure', 'bottom_pressure', 'pulse'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['observation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Observations::className(), 'targetAttribute' => ['observation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'observation_id' => 'Наблюдение',
            'top_pressure' => 'Верхнее давление',
            'bottom_pressure' => 'Нижнее давление',
            'pulse' => 'Пульс',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Observation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObservation()
    {
        return $this->hasOne(Observations::className(), ['id' => 'observation_id']);
    }
}
