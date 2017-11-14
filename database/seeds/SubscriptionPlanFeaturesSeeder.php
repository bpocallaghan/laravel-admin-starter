<?php



use Illuminate\Database\Seeder;
use Bpocallaghan\Subscriptions\Models\SubscriptionPlanFeature;

class SubscriptionPlanFeaturesSeeder extends Seeder
{
    public function run()
    {
        SubscriptionPlanFeature::truncate();

        $csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'subscription_plan_features.csv';
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