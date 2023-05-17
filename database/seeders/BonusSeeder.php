<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bonus;
class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bonus::create([
            'bonus_name' => 'welcome_bonus',
            'coins' => '5',
        ]);
        Bonus::create([
                'bonus_name' => 'image_upload_bonus',
                'coins' => '10',
        ]);
        Bonus::create([
                'bonus_name' => 'referral_bonus',
                'coins' => '50',
        ]);
    }
}
