<?php

use App\Models\SubscriptionPlanFeature;
use Illuminate\Database\Seeder;

class SubscriptionPlanFeaturesSeeder extends Seeder
{
    public function run()
    {
        SubscriptionPlanFeature::truncate();

        $csvPath = database_path() . '/seeds/csv/' . 'subscription_plan_features.csv';
        $items = csv_to_array($csvPath);

        foreach ($items as $key => $item) {
            $row = SubscriptionPlanFeature::create([
                'id'         => $item['id'],
                'title'      => $item['title'],
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}