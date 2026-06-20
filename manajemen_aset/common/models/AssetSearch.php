<?php

namespace common\models; // atau common\models tergantung kamu simpan di mana

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Asset;

class AssetSearch extends Asset
{
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'category_id', 'economic_life'], 'integer'],
            [['name', 'location', 'status', 'qr_code', 'purchase_date', 'user', 'created_at', 'updated_at', 'globalSearch'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Asset::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => 10],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
            'economic_life' => $this->economic_life,
            'purchase_date' => $this->purchase_date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'location', $this->location])
              ->andFilterWhere(['like', 'status', $this->status])
              ->andFilterWhere(['like', 'qr_code', $this->qr_code])
              ->andFilterWhere(['like', 'user', $this->user]);

        if (!empty($this->globalSearch)) {
            $query->andFilterWhere([
                'or',
                ['like', 'name', $this->globalSearch],
                ['like', 'location', $this->globalSearch],
                ['like', 'qr_code', $this->globalSearch],
                ['like', 'user', $this->globalSearch],
            ]);
        }

        return $dataProvider;
    }
}
