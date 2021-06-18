<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "observations".
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $patient_id
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $result
 * @property string $created_at
 * @property string $updated_at
 *
 * @property History[] $histories
 * @property Users $doctor
 * @property Users $patient
 * @property ObservationsData[] $observationsDatas
 */
class Observations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'observations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'patient_id', 'start_date'], 'required'],
            [['doctor_id', 'patient_id'], 'integer'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['result'], 'string'],
            [['doctor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['doctor_id' => 'id']],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_id' => 'Врач',
            'patient_id' => 'Пациент',
            'start_date' => 'Начало наблюдения',
            'end_date' => 'Конец наблюдения',
            'result' => 'Результат',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Histories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['observation_id' => 'id']);
    }

    /**
     * Gets query for [[Doctor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoctor()
    {
        return $this->hasOne(Users::className(), ['id' => 'doctor_id']);
    }

    /**
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Users::className(), ['id' => 'patient_id']);
    }

    /**
     * Gets query for [[ObservationsDatas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObservationsDatas()
    {
        return $this->hasMany(ObservationsData::className(), ['observation_id' => 'id']);
    }
}
