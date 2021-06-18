<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property int $id
 * @property int $observation_id
 * @property int $patient_id
 * @property string|null $drug
 * @property string|null $drug_meta
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Observations $observation
 * @property Users $patient
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['observation_id', 'patient_id'], 'required'],
            [['observation_id', 'patient_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['drug', 'drug_meta'], 'string', 'max' => 255],
            [['observation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Observations::className(), 'targetAttribute' => ['observation_id' => 'id']],
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
            'observation_id' => 'Наблюдение',
            'patient_id' => 'Пациент',
            'drug' => 'Препарат',
            'drug_meta' => 'Информация о приеме',
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

    /**
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(Users::className(), ['id' => 'patient_id']);
    }
}
