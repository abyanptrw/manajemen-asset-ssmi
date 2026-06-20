<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MaintenanceSchedule;

class MaintenanceScheduleSearch extends MaintenanceSchedule
{
    public function rules()
    {
        return [
            [['id', 'asset_id'], 'integer'],
            [['asset_name', 'description', 'date', 'status', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MaintenanceSchedule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['date' => SORT_ASC]],
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'asset_id' => $this->asset_id,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'asset_name', $this->asset_name])
              ->andFilterWhere(['like', 'description', $this->description])
              ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
