<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "maintenance_schedule".
 *
 * @property int $id
 * @property string $asset_name
 * @property string|null $description
 * @property string $date
 * @property string $created_at
 */
class MaintenanceSchedule extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'maintenance_schedule';
    }

    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['asset_name', 'date'], 'required'],
            [['description'], 'string'],
            [['date', 'created_at'], 'safe'],
            [['asset_name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asset_name' => 'Nama Aset',
            'description' => 'Deskripsi',
            'date' => 'Tanggal',
            'created_at' => 'Created At',
        ];
    }

    // Tambahan: agar created_at otomatis terisi
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }
}
