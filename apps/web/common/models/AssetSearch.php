<?php

namespace common\models; // atau common\models tergantung kamu simpan di mana

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Asset;

class AssetSearch extends Asset
{
    public function rules()
    {
        return [
            [['name', 'status', 'location', 'user'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Asset::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'status', $this->status])
              ->andFilterWhere(['like', 'location', $this->location])
              ->andFilterWhere(['like', 'user', $this->user]);

        return $dataProvider;
    }
}
