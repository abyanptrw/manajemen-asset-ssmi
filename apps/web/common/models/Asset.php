<?php

namespace common\models;

use yii\db\ActiveRecord;


class Asset extends ActiveRecord
{
    
    public $photoFile;
    public static function tableName()
    {
        return 'asset';
    }

    public function rules()
    {
        return [
            [['name', 'category_id', 'status'], 'required'],
            [['category_id'], 'integer'],
            [['name', 'location'], 'string', 'max' => 100],
            [['status'], 'in', 'range' => ['available', 'checked_out', 'maintenance']],
            [['qr_code'], 'string', 'max' => 255],
            [['purchase_date'], 'date', 'format' => 'php:Y-m-d'],
            [['user'], 'string', 'max' => 255],
            [['economic_life'], 'required'],
            [['economic_life'], 'integer', 'min' => 1],
           /* [['photoFile'], 'file', 'extensions' => 'png, jpg, jpeg', 'skipOnEmpty' => true], */


        ];
    }

    // Relasi ke category (AssetCategory)
    public function getCategory()
    {
        return $this->hasOne(AssetCategory::class, ['id' => 'category_id']);
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama Aset',
            'category_id' => 'Kategori',
            'location' => 'Lokasi',
            'status' => 'Status',
            'qr_code' => 'QR Code',
            'created_at' => 'Dibuat Pada',
            'updated_at' => 'Diubah Pada',
            'purchase_date' => 'Purchase Date',
            'user' => 'User',
            /* 'photo' => 'Foto Aset' */
        ];
    }


    public static function getUsageReport()
    {
        return self::find()
            ->select(['category_id', 'COUNT(*) AS total'])
            ->groupBy('category_id')
            ->asArray()
            ->all();
    }

    public static function getReplacementPrediction($currentYear)
    {
        return self::find()
            ->select(['name', 'purchase_date', "($currentYear - YEAR(purchase_date)) AS age"])
            ->where("($currentYear - YEAR(purchase_date)) >= 5") // Asumsi umur ekonomis adalah 5 tahun
            ->asArray()
            ->all();
    }

    // File: common/models/Asset.php

public function getReplacementStatus()
{
    // Contoh logika: jika umur lebih dari 5 tahun, perlu diganti
    if ($this->age > 5) {
        return 'Perlu Diganti';
    } else {
        return 'Masih Layak';
    }
}

    public static function getCheckedOutAssets()
    {
        return self::find()
            ->select(['name', 'status', 'user', 'purchase_date'])
            ->where(['status' => 'checked_out'])
            ->asArray()
            ->all();
    }
   public function getAge()
    {
        if (empty($this->purchase_date)) {
            return '-'; // atau bisa juga return 0;
        }

        try {
            $purchaseDate = new \DateTime($this->purchase_date);
            $now = new \DateTime();
            $interval = $purchaseDate->diff($now);
            return $interval->y;  // umur dalam tahun
        } catch (\Exception $e) {
            return '-'; // fallback kalau formatnya tidak valid
        }
    }
    




}
