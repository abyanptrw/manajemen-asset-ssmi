<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "asset".
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string|null $location
 * @property string $status
 * @property string|null $qr_code
 * @property string $created_at
 * @property string $updated_at
 *
 * @property AssetCategory $category
 */
class Asset extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_AVAILABLE = 'available';
    const STATUS_CHECKED_OUT = 'checked_out';
    const STATUS_MAINTENANCE = 'maintenance';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asset';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location', 'qr_code'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'available'],
            [['name', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'location'], 'string', 'max' => 100],
            [['qr_code'], 'string', 'max' => 255],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssetCategory::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'location' => 'Location',
            'status' => 'Status',
            'qr_code' => 'Qr Code',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(AssetCategory::class, ['id' => 'category_id']);
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_AVAILABLE => 'available',
            self::STATUS_CHECKED_OUT => 'checked_out',
            self::STATUS_MAINTENANCE => 'maintenance',
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusAvailable()
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function setStatusToAvailable()
    {
        $this->status = self::STATUS_AVAILABLE;
    }

    /**
     * @return bool
     */
    public function isStatusCheckedout()
    {
        return $this->status === self::STATUS_CHECKED_OUT;
    }

    public function setStatusToCheckedout()
    {
        $this->status = self::STATUS_CHECKED_OUT;
    }

    /**
     * @return bool
     */
    public function isStatusMaintenance()
    {
        return $this->status === self::STATUS_MAINTENANCE;
    }

    public function setStatusToMaintenance()
    {
        $this->status = self::STATUS_MAINTENANCE;
    }
}
