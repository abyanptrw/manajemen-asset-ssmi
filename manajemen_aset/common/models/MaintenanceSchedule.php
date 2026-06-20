<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "maintenance_schedule".
 *
 * @property int $id
 * @property int $asset_id
 * @property string $asset_name
 * @property string|null $description
 * @property string $date
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Asset $asset
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
            [['asset_id', 'date'], 'required'],
            [['asset_id'], 'integer'],
            [['description'], 'string'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['asset_name'], 'string', 'max' => 255],
            [['status'], 'in', 'range' => ['pending', 'done']],
            [['status'], 'default', 'value' => 'pending'],
            [['description'], 'default', 'value' => null],
            [['asset_id'], 'exist', 'skipOnError' => true, 'targetClass' => Asset::class, 'targetAttribute' => ['asset_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asset_id' => 'Aset',
            'asset_name' => 'Nama Aset',
            'description' => 'Deskripsi',
            'date' => 'Tanggal',
            'status' => 'Status',
            'created_at' => 'Dibuat Pada',
            'updated_at' => 'Diubah Pada',
        ];
    }

    /**
     * Relasi ke model Asset
     */
    public function getAsset()
    {
        return $this->hasOne(Asset::class, ['id' => 'asset_id']);
    }

    // Agar created_at dan updated_at otomatis terisi
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            $this->updated_at = date('Y-m-d H:i:s');
            
            if (!empty($this->date)) {
                // Ensure date format has a space instead of 'T' from datetime-local input
                $this->date = str_replace('T', ' ', $this->date);
                if (strlen($this->date) == 16) {
                    $this->date .= ':00'; // Append seconds if missing
                }
            }
            return true;
        }
        return false;
    }
}
