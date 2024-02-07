<?php

namespace Hup234design\FilamentCms\Database\Seeders;

use Hup234design\FilamentCms\Models\IndexPage;
use Illuminate\Database\Seeder;

class IndexPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IndexPage::updateOrCreate(
            [
                'slug' => 'posts',
            ],
            [
                'title' => 'Posts',
            ]
        );

        IndexPage::updateOrCreate(
            [
                'slug' => 'services',
            ],
            [
                'title' => 'Services',
            ]
        );

        IndexPage::updateOrCreate(
            [
                'slug' => 'testimonials',
            ],
            [
                'title' => 'Testimonials',
            ]
        );
    }
}
