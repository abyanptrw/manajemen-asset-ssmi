<?php

namespace common\models;

use yii\db\ActiveRecord;

class AssetCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'asset_category';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['name'], 'unique'],
            [['description'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama Kategori',
            'description' => 'Deskripsi',
            'created_at' => 'Dibuat Pada',
            'updated_at' => 'Diubah Pada',
        ];
    }

    // Jika ingin, bisa relasi balik ke Asset
    public function getAssets()
    {
        return $this->hasMany(Asset::class, ['category_id' => 'id']);
    }
}
