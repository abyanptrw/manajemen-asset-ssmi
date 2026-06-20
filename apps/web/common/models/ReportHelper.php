<?php

namespace common\models;

class ReportHelper
{
    public static function formatUsageReport($data)
    {
        $formatted = [];
        foreach ($data as $item) {
            $category = AssetCategory::findOne($item['category_id']);
            $formatted[] = [
                'category' => $category->name ?? 'Tidak Diketahui',
                'total' => $item['total'],
            ];
        }
        return $formatted;
    }
}
