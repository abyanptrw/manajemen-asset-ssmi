<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "maintenance_schedule".
 *
 * @property int $id
 * @property string $asset_name
 * @property string $
 * @property string|null $description
 * @property string $date
 * @property string $created_at
 */
class MaintenanceSchedule extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'maintenance_schedule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'default', 'value' => null],
            [['asset_name', '', 'date'], 'required'],
            [['description'], 'string'],
            [['date', 'created_at'], 'safe'],
            [['asset_name', ''], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asset_name' => '',
            '' => '',
            'description' => 'Description',
            'date' => 'Date',
            'created_at' => 'Created At',
        ];
    }

}
