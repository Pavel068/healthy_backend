<?php

namespace app\models;

use app\models\Users;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UsersSearch represents the model behind the search form of `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'patient_id'], 'integer'],
            [['insurance_number', 'password', 'full_name', 'role', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        if (\Yii::$app->user->identity) {
            if (\Yii::$app->user->identity->role == 'admin') {
                $query = Users::find()->where(['role' => 'doctor']);
            } else if (\Yii::$app->user->identity->role == 'doctor') {
                $query = Users::find()->where(['role' => 'patient']);
            }
        } else {
            $query = Users::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'patient_id' => $this->patient_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'insurance_number', $this->insurance_number])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'role', $this->role]);

        return $dataProvider;
    }
}
