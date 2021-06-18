<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $insurance_number
 * @property string $password
 * @property string $full_name
 * @property string $role
 * @property int|null $patient_id
 * @property string|null $access_token
 * @property string $created_at
 * @property string $updated_at
 *
 * @property History[] $histories
 * @property Observations[] $observations
 * @property Observations[] $observations0
 * @property PatientsData $patient
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['insurance_number', 'password', 'full_name', 'role'], 'required'],
            [['role'], 'string'],
            [['patient_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['insurance_number', 'password', 'full_name', 'access_token'], 'string', 'max' => 255],
            [['insurance_number'], 'unique'],
            [['patient_id'], 'exist', 'skipOnError' => true, 'targetClass' => PatientsData::className(), 'targetAttribute' => ['patient_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (isset($this->password)) {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'insurance_number' => 'Insurance Number',
            'password' => 'Password',
            'full_name' => 'Full Name',
            'role' => 'Role',
            'patient_id' => 'Patient ID',
            'access_token' => 'Access Token',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Histories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHistories()
    {
        return $this->hasMany(History::className(), ['patient_id' => 'id']);
    }

    /**
     * Gets query for [[Observations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObservations()
    {
        return $this->hasMany(Observations::className(), ['doctor_id' => 'id']);
    }

    /**
     * Gets query for [[Observations0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getObservations0()
    {
        return $this->hasMany(Observations::className(), ['patient_id' => 'id']);
    }

    /**
     * Gets query for [[Patient]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPatient()
    {
        return $this->hasOne(PatientsData::className(), ['id' => 'patient_id']);
    }
}
