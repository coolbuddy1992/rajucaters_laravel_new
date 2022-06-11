<?php

namespace Database\Seeders;

use App\Models\Build_own_menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Build_own_menu::Create(
            [
                [
                'menu_name_en' => 'RC Signature Menu',
                'menu_name_hi' => 'आरसी हस्ताक्षर मेन्यू',
                'slug_en' => 'rc-signature-menu',
                'slug_hi' => 'आरसी-हस्ताक्षर-मेन्यू',
                ],
                [
                    'menu_name_en' => 'RC Classic Menu',
                    'menu_name_hi' => 'आरसी क्लासिक मेन्यू',
                    'slug_en' => 'rc-classic-मेन्यू',
                    'slug_hi' => 'आरसी-क्लासिक-मेन्यू',
                ],
                [
                    'menu_name_en' => 'Customize Menu',
                    'menu_name_hi' => 'मेन्यू अनुकूलित करें',
                    'slug_en' => 'customize-Menu',
                    'slug_hi' => 'मेन्यू-अनुकूलित-करें',
                ]
            ]
        );
    }
}
