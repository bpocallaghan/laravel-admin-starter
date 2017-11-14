<?php



use Illuminate\Database\Seeder;
use Bpocallaghan\Subscriptions\Models\SubscriptionPlan;
use Bpocallaghan\Subscriptions\Models\SubscriptionPlanFeature;

class SubscriptionPlanTableSeeder extends Seeder
{
    public function run()
    {
        SubscriptionPlan::truncate();
        DB::delete('TRUNCATE subscription_plan_feature_pivot');

        $csvPath = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'csv' . DIRECTORY_SEPARATOR . 'subscription_plans.csv';
        $items = csv_to_array($csvPath);

        foreach ($items as $key => $item) {
            $row = SubscriptionPlan::create([
                'id'          => $item['id'],
                'is_featured' => $item['is_featured'],
                'title'       => $item['title'],
                'summary'     => $item['summary'],
                'cost'        => $item['cost'],
                'created_by'  => 1,
                'updated_by'  => 1,
            ]);

            // get 5 features for each and set list order
            $featureRows = SubscriptionPlanFeature::where('id', '>=', ($key * 5))
                ->where('id', '<=', ($key * 5 + 5))
                ->get();

            $features = [];
            foreach ($featureRows as $i => $featureRow) {
                $features[$featureRow->id] = ['list_order' => ($i + 1)];
            }
            $row->features()->attach($features);
        }
    }
}