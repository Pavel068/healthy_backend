<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patients_data".
 *
 * @property int $id
 * @property string $birthday
 * @property int $height
 * @property float $weight
 * @property string|null $extra
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Users[] $users
 */
class PatientsData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patients_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'birthday', 'height', 'weight'], 'required'],
            [['id', 'height'], 'integer'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['weight'], 'number'],
            [['extra'], 'string'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'birthday' => 'Дата рождения',
            'height' => 'Рост',
            'weight' => 'Вес',
            'extra' => 'Дополнительно',
            'created_at' => 'Добавлено',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['patient_id' => 'id']);
    }
}
