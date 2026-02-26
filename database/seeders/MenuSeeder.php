<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Enum\CommonStatus;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Seed header menu items (existing menu names from frontend layout).
     */
    public function run(): void
    {
        $items = [
            ['slug' => 'home', 'menu_name' => 'Home', 'url' => '/', 'sort_order' => 1],
            ['slug' => 'about_us', 'menu_name' => 'About Us', 'url' => '#', 'sort_order' => 2],
            ['slug' => 'products', 'menu_name' => 'Products', 'url' => null, 'sort_order' => 3], // route in layout
            ['slug' => 'capacity', 'menu_name' => 'Capacity', 'url' => null, 'sort_order' => 4],
            ['slug' => 'sustainability', 'menu_name' => 'Sustainability', 'url' => null, 'sort_order' => 5],
            ['slug' => 'sister_concerns', 'menu_name' => 'Sister Concerns​', 'url' => '#', 'sort_order' => 6],
            ['slug' => 'machineries_automation', 'menu_name' => 'Mechinaries Automation', 'url' => null, 'sort_order' => 7],
            ['slug' => 'news_events', 'menu_name' => 'News & Events', 'url' => null, 'sort_order' => 8],
            ['slug' => 'cultural_activities', 'menu_name' => 'Cultural Activities', 'url' => null, 'sort_order' => 9],
            ['slug' => 'manufacturing_process', 'menu_name' => 'Manufacturing Process', 'url' => null, 'sort_order' => 10],
            ['slug' => 'career', 'menu_name' => 'Career​', 'url' => null, 'sort_order' => 11],
            ['slug' => 'get_in_touch', 'menu_name' => 'Get In Touch', 'url' => null, 'sort_order' => 12],
        ];

        foreach ($items as $item) {
            Menu::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'menu_name' => $item['menu_name'],
                    'url' => $item['url'],
                    'sort_order' => $item['sort_order'],
                    'status' => CommonStatus::Active,
                ]
            );
        }
    }
}
